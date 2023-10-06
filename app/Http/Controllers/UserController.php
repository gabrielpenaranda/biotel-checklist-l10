<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;
use App\Models\DeletedUser;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UserPasswordUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $users = User::orderBy('name', 'asc')->paginate(10);
        return view('admin.user.index', compact('users')); */
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        $titulo = 'Biotel|Crear Usuario';
        return view('admin.user.form', compact('user', 'titulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->identification = $request->get('identification');
        $user->position = $request->get('position');
        $user->password = bcrypt($request->get('password'));
        $user->first = 0;
        $user->second = 0;
        $user->deleted = false;
        $user->date_to = Carbon::now();
        $user->save();
        $log = new Log;
        $log->register($log, 'C', $user->name, $user->id,'users', auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Usuario creado');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $titulo = 'Biotel|Ver Usuario';
        return view('admin.user.show', compact('user', 'titulo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $titulo = 'Biotel|Editar Usuario';
        return view('admin.user.form', compact('user', 'titulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->name = $request->get('name');
        $user->position = $request->get('position');
        $user->update();
        $log = new Log;
        $log->register($log, 'U', $user->name, $user->id,'users', auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Usuario actualizado');
        return redirect()->route('user.index');
    }

    public function show_destroy(User $user)
    {
        $titulo = 'Biotel|Eliminar Usuario';
        return view('admin.user.show_destroy', compact('user', 'titulo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        /* try {
            if ($user->id == 1) {
                session()->flash('warning', 'No puede eliminar al administrador del sistema');
                return redirect()->route('user.index');
            }
            $user->delete();
            $deleted_user = new DeletedUser;
            $deleted_user->name = $user->name;
            $deleted_user->email = $user->email;
            $deleted_user->identification = $user->identification;
            $deleted_user->position = $user->position;
            $deleted_user->old_id = $user->id;
            $deleted_user->date_since = $user->created;
            $deleted_user->date_to = Carbon::now();
            $deleted_user->save();
            $log = new Log;
            $log->register($log, 'D', $user->name, $user->id,'users', auth()->user()->name, auth()->user()->identification);
            $log = new Log;
            $log->register($log, 'C', $deleted_user->name, $user->old_id,'deleted_users', auth()->user()->name, auth()->user()->identification);
            session()->flash('message', 'Usuario eliminado');
            return redirect()->route('user.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el usuario, posee información relacionada');
                return redirect()->route('user.index');
            }
        }
        if ($user->id == 1) {
            session()->flash('warning', 'No puede eliminar al administrador del sistema');
            return redirect()->route('user.index');
        } */
        /* $user->delete();
        $deleted_user = new DeletedUser;
        $deleted_user->name = $user->name;
        $deleted_user->email = $user->email;
        $deleted_user->identification = $user->identification;
        $deleted_user->position = $user->position;
        $deleted_user->old_id = $user->id;
        $deleted_user->date_since = $user->created_at;
        $deleted_user->date_to = Carbon::now();
        $deleted_user->first = $user->first;
        $deleted_user->second = $user->second;
        $deleted_user->save(); */
        $user->deleted = true;
        $user->password = '';
        $user->date_to = Carbon::now();
        $user->update();
        $log = new Log;
        $log->register($log, 'D', $user->name, $user->id, 'users', auth()->user()->name, auth()->user()->identification);
       /*  $log = new Log;
        $log->register($log, 'C', $deleted_user->name, $deleted_user->old_id, 'deleted_users', auth()->user()->name, auth()->user()->identification); */
        session()->flash('message', 'Usuario eliminado');
        return redirect()->route('user.index');
    }

    public function edit_password(User $user)
    {
        $titulo = 'Biotel|Cambiar Password';
        return view('admin.user.change_password', compact('user', 'titulo'));
    }

    public function update_password(UserPasswordUpdateRequest $request, User $user)
    {
        $user->password = bcrypt($request->get('password'));
        $user->update();
        $log = new Log;
        $log->register($log, 'U', 'Cambio password '.$user->name, $user->id,'users', auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Contraseña de usuario actualizada');
        return redirect()->route('user.index');
    }

    public function edit_permission(User $user)
    {
        $titulo = 'Biotel|Editar Permisos';
        $permissions = Permission::orderBy('name', 'asc')->get();
        // $user_permissions = $user->permissions;
        $user_permissions = $user->getPermissionNames();
        return view('admin.user.edit_permission', compact('user', 'titulo', 'permissions', 'user_permissions'));
    }

    public function update_permission(Request $request, User $user)
    {
        $app = [
            1 => [
                'name' => 'checklist-model-index',
                'permission' => 'checklist-model.index',
            ],
            2 => [
                'name' => 'checklist-model-create',
                'permission' => 'checklist-model.create',
            ],
            3 => [
                'name' => 'checklist-model-edit',
                'permission' => 'checklist-model.edit',
            ],
            4 => [
                'name' => 'checklist-model-show',
                'permission' => 'checklist-model.show',
            ],
            5 => [
                'name' => 'checklist-model-destroy',
                'permission' => 'checklist-model.destroy',
            ],
            6 => [
                'name' => 'checklist-model-clone',
                'permission' => 'checklist-model.clone',
            ],
            7 => [
                'name' => 'element-model-index',
                'permission' => 'element-model.index',
            ],
            8 => [
                'name' => 'element-model-create',
                'permission' => 'element-model.create',
            ],
            9 => [
                'name' => 'element-model-edit',
                'permission' => 'element-model.edit',
            ],
            10 => [
                'name' => 'element-model-destroy',
                'permission' => 'element-model.destroy',
            ],
            11 => [
                'name' => 'checklist-index',
                'permission' => 'checklist.index',
            ],
            12 => [
                'name' => 'checklist-create',
                'permission' => 'checklist.create',
            ],
            13 => [
                'name' => 'checklist-show',
                'permission' => 'checklist.show',
            ],
            14 => [
                'name' => 'checklist-first-edit',
                'permission' => 'checklist.first-edit',
            ],
            15 => [
                'name' => 'checklist-second-edit',
                'permission' => 'checklist.second-edit',
            ],
            16 => [
                'name' => 'checklist-first-verify-edit',
                'permission' => 'checklist.first-verify-edit',
            ],
            17 => [
                'name' => 'checklist-second-verify-edit',
                'permission' => 'checklist.second-verify-edit',
            ],
            18 => [
                'name' => 'checklist-interchange',
                'permission' => 'checklist.interchange',
            ],
            19 => [
                'name' => 'checklist-checklist-by-user',
                'permission' => 'checklist.checklist-by-user',
            ],
            20 => [
                'name' => 'checklist-pdf',
                'permission' => 'checklist.pdf',
            ],
            21 => [
                'name' => 'checklist-expired',
                'permission' => 'checklist.expired',
            ],
            22 => [
                'name' => 'checklist-enable',
                'permission' => 'checklist.enable',
            ],
            23 => [
                'name' => 'user-index',
                'permission' => 'user.index',
            ],
            24 => [
                'name' => 'user-create',
                'permission' => 'user.create',
            ],
            25 => [
                'name' => 'user-edit',
                'permission' => 'user.edit',
            ],
            26 => [
                'name' => 'user-destroy',
                'permission' => 'user.destroy',
            ],
            27 => [
                'name' => 'user-edit-password',
                'permission' => 'user.edit-password',
            ],
            28 => [
                'name' => 'user-edit-permission',
                'permission' => 'user.edit-permission',
            ],
            29 => [
                'name' => 'user-show-deleted-user',
                'permission' => 'user.show-deleted-user',
            ],
            30 => [
                'name' => 'user-list-all-users',
                'permission' => 'user.list-all-users',
            ],
            31 => [
                'name' => 'log-show',
                'permission' => 'log.show',
            ],

        ];


        for($i = 1; $i <= 31; $i++) {
            $permission = (bool)$request->get($app[$i]['name']);
            if ($user->hasPermissionTo($app[$i]['permission']) && !$permission) {
                $user->revokePermissionTo($app[$i]['permission']);
            } else if (!$user->hasPermissionTo($app[$i]['permission']) && $permission) {
                $user->givePermissionTo($app[$i]['permission']);
            }
        }

        $log = new Log;
        $log->register($log, 'U', 'Cambiar permisos ' . $user->name, $user->id, 'users', auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Permisos de usuario actualizados');
        return redirect()->route('user.index');
    }

    public function show_deleted_users()
    {
        $deleted_users = User::where('deleted', true)
                            ->orderBy('date_to', 'desc')
                            ->paginate(10);
        $titulo = 'Biotel|Usuarios eliminados';
        return view('admin.user.show_deleted_users', compact('deleted_users', 'titulo'));
    }
}
