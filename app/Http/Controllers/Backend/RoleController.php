<?php namespace App\Http\Controllers\Backend;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Repositories\Roles\RoleRepository;

//@fixme
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Pingpong\Admin\Validation\Role\Create;
use Pingpong\Admin\Validation\Role\Update;

class RoleController extends BackendController
{
    protected $repository;

    public function __construct(RoleRepository $repository)
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
        return redirect()->route('backend.roles.index');
    }

    /**
     * Display a listing of roles
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = $this->repository->allOrSearch($request->query->get('q'));

        $no = $roles->firstItem();

        return view('backend.roles.index', compact('roles', 'no'));
    }

    /**
     * Show the form for creating a new role
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.roles.create');
    }

    /**
     * Store a newly created role in storage.
     * @param Create $request
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified role.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $role = $this->repository->findById($id);
            return view('backend.roles.show', compact('role'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $role = $this->repository->findById($id);

            $permission_role = $role->permissions->lists('id');

            return view('backend.roles.edit', compact('role', 'permission_role'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified role in storage.
     * @param Update $request
     * @param  int   $id
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $role = $this->repository->findById($id);
            
            $data = $request->all();

            $role->update($data);

            if ($role->permissions->count()) {
                $role->permissions()->detach($role->permissions->lists('id'));

                $role->permissions()->attach(\Input::get('permissions'));
            }

            if ($role->permissions->count() == 0 && count(\Input::get('permissions')) > 0) {
                $role->permissions()->attach(\Input::get('permissions'));
            }

            return redirect()->route('roles.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return redirect()->route('roles.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
