<?php namespace App\Http\Controllers\Admin;

use App\Http\Models\Www\Nag;
use App\Http\Models\Www\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Repositories\Users\UserRepository;

//@fixme
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\User\Create;
use App\Http\Requests\User\Update;

class NagController extends AdminBaseController
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
        return redirect()->route('users.index');
    }

    /**
     * Display a listing of users
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $nagging = Nag::getInstance()->findAll();

        return view('admin.nagging.index', compact('nagging'));
    }

    /**
     * Show the form for creating a new user
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.users.create');
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

        return redirect()->route('users.index');
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
            return view('admin.users.show', compact('user'));
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

            return view('admin.users.edit', compact('user', 'role'));
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
        dd(123);
        try {
            $data = ! $request->has('password') ? $request->except('password') : $this->inputAll();
            
            $user = $this->repository->findById($id);
            
            $user->update($data);

            $user->roles()->sync((array) \Input::get('role'));

            return redirect()->route('users.index');
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

            return redirect()->route('users.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
