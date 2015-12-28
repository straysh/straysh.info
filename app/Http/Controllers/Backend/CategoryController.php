<?php namespace App\Http\Controllers\Backend;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Models\Frontend\Category;
use App\Http\Repositories\Categories\CategoryRepository;
//@fixme
use Illuminate\Http\Response;
use App\Http\Requests\Category\Create;
use App\Http\Requests\Category\Update;

class CategoryController extends BackendController
{
    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }
    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return redirect()->route('categories.index');
    }

    /**
     * Display a listing of categories
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = $this->repository->allOrSearch($request->get('q'));
     
        $no = $categories->firstItem();

        return view('backend.categories.index', compact('categories', 'no'));
    }

    /**
     * Show the form for creating a new category
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created category in storage.
     * @param Create $request
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();

        $category = Category::create($data);

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified category.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $category = $this->repository->findById($id);

            return view('backend.categories.show', compact('category'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $category = $this->repository->findById($id);

            return view('backend.categories.edit', compact('category'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified category in storage.
     * @param Update $request
     * @param  int   $id
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $data = $request->all();

            $category = $this->repository->findById($id);

            $category->update($data);

            return redirect()->route('categories.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return redirect()->route('categories.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
