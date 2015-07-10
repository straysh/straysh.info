<?php namespace App\Http\Controllers\Backend;

use App\Models\Frontend\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Repositories\Users\UserRepository;

//@fixme
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Pingpong\Admin\Validation\User\Create;
use Pingpong\Admin\Validation\User\Update;

class UsersController extends BackendController
{

    /**
     * @var User
     */
    protected $users;

    /**
     * @param UserRepository $repository
     * @internal param User $users
     */
    public function __construct(UserRepository $repository)
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
        return $this->redirect('users.index');
    }

    /**
     * Display a listing of users
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->repository->allOrSearch($request->query->get('q'));

        $no = $users->firstItem();

        return view('users.index', compact('users', 'no'));
    }

    /**
     * Show the form for creating a new user
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     * @param Create $request
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();

        $user = $this->repository->create($data);

        $user->addRole($request->get('role'));

        return $this->redirect('users.index');
    }

    /**
     * Display the specified user.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = $this->repository->findById($id);
            return view('users.show', compact('user'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $user = $this->repository->findById($id);

            $role = $user->roles->lists('id');

            return view('users.edit', compact('user', 'role'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified user in storage.
     * @param Update $request
     * @param  int   $id
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $data = ! $request->has('password') ? $request->except('password') : $this->inputAll();
            
            $user = $this->repository->findById($id);
            
            $user->update($data);

            $user->roles()->sync((array) \Input::get('role'));

            return $this->redirect('users.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->redirect('users.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
