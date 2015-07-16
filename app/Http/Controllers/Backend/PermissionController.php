<?php namespace App\Http\Controllers\Backend;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Repositories\Permissions\PermissionRepository;
//@fixme
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Permission\Create;
use App\Http\Requests\Permission\Update;

class PermissionController extends BackendController
{
    protected $repository;

    public function __construct(PermissionRepository $repository)
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
        return redirect()->route('permissions.index');
    }

    /**
     * Display a listing of permissions
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $permissions = $this->repository->allOrSearch($request->query->get('q'));

        $no = $permissions->firstItem();

        return view('backend.permissions.index', compact('permissions', 'no'));
    }

    /**
     * Show the form for creating a new permission
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     * @param Create $request
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified permission.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $permission = $this->repository->findById($id);

            return view('backend.permissions.show', compact('permission'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $permission = $this->repository->findById($id);

            return view('backend.permissions.edit', compact('permission'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified permission in storage.
     * @param Update $request
     * @param  int   $id
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $permission = $this->repository->findById($id);
                
            $data = $request->all();
            
            $permission->update($data);

            return redirect()->route('permissions.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return redirect()->route('permissions.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
