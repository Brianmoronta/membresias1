<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Mostrar listado de usuarios
    public function index()
    {
        $usuarios = User::with('roles')->get();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    // Mostrar formulario para crear usuario
    public function create()
    {
        $roles = Role::pluck('name');
        $sucursales = Sucursal::all(); // ← listado para el select
        return view('admin.usuarios.create', compact('roles', 'sucursales'));
    }

    // Guardar nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,servicio,cliente',
            'idsucursal' => 'nullable|integer',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'idsucursal' => $request->idsucursal,
            'es_usuario_club' => $request->has('es_usuario_club'), // 👈 campo booleano
        ]);

        // Obligarlo a cambiar la clave si es admin de sucursal
        if ($user->role === 'admin' && $user->idsucursal != 0 && $user->idsucursal != 9999) {
            $user->debe_cambiar_clave = true;
            $user->save();
        }

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // Mostrar formulario para editar solo el rol
    public function editRole(User $user)
    {
        $roles = Role::pluck('name');
        return view('admin.usuarios.edit', compact('user', 'roles'));
    }

    // Actualizar solo el rol
    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Rol actualizado correctamente.');
    }

    // Mostrar formulario para editar todos los datos del usuario
    public function edit(User $user)
    {
        $sucursales = Sucursal::all(); // ← para llenar el select
        return view('admin.usuarios.edit-user', compact('user', 'sucursales'));
    }

    // Actualizar todos los datos del usuario
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'password'   => 'nullable|string|min:6',
            'idsucursal' => 'nullable|integer|exists:sucursals,id',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->idsucursal = $request->idsucursal;
        $user->es_usuario_club = $request->has('es_usuario_club'); // 👈 actualizar también

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function perfil()
{
    $user = auth()->user();
    $reservas = $user->reservas()->latest()->get();

    return view('member.perfil', compact('user', 'reservas'));
}

}
