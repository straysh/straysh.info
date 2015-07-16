<?php namespace App\Http\Controllers\Backend;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
//@fixme
use App\Helpers\ImageHelper as ImageUploader;
use App\Http\Requests\Article\Create;
use App\Http\Requests\Article\Update;

class ArticleController extends BackendController
{

    protected $articles;

    /**
     * @var ImageUploader
     */
    protected $uploader;

    /**
     * @param ImageUploader $uploader
     */
    public function __construct(ImageUploader $uploader)
    {
        parent::__construct();
        $this->uploader = $uploader;

        $this->repository = $this->getRepository();
    }

    /**
     * Get repository instance.
     *
     * @return mixed
     */
    public function getRepository()
    {
        if (isOnPages()) {
            $repository = 'App\Http\Repositories\Pages\PageRepository';
        } else {
            $repository = 'App\Http\Repositories\Articles\ArticleRepository';
        }

        return app($repository);
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect()->route(isOnPages() ? 'pages.index' : 'articles.index')
            ->withFlashMessage('Post not found!')
            ->withFlashType('danger');
    }

    /**
     * Display a listing of articles
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $articles = $this->repository->allOrSearch($request->query->get('q'));

        $no = $articles->firstItem();

        return view('backend.articles.index', compact('articles', 'no'));
    }

    /**
     * Show the form for creating a new article
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.articles.create');
    }

    /**
     * Store a newly created article in storage.
     * @param Create $request
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['title']);

        $this->repository->create($data);

        return redirect()->route(isOnPages() ? 'pages.index' : 'articles.index');
    }

    /**
     * Display the specified article.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $article = $this->repository->findById($id);

            return view('backend.articles.show', compact('article'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $article = $this->repository->findById($id);

            return view('backend.articles.edit', compact('article'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified article in storage.
     * @param Update $request
     * @param  int   $id
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $article = $this->repository->findById($id);

            $data = $request->all();
            $data['user_id'] = Auth::id();
            $data['slug'] = Str::slug($data['title']);
            $article->update($data);

            return redirect()->route(isOnPages() ? 'pages.index' : 'articles.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return redirect()->route(isOnPages() ? 'pages.index' : 'articles.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
