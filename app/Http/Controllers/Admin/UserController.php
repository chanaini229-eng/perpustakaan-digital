<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    // Menampilkan formulir tambah pengguna
    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('users.create', compact('roles'));
    }

    // Menyimpan pengguna baru
    
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'exists:roles,name'],
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    $user->syncRoles([$validated['role']]);

    return redirect()->route('admin.users.index')
        ->with('success', 'Pengguna berhasil ditambahkan.');
}


    // Menampilkan formulir edit pengguna
    public function edit(User $user)
    {
        $roles = Role::orderBy('name')->get();
        $userRole = $user->getRoleNames()->first();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    // Memperbarui data dan role pengguna
    
public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('users', 'email')->ignore($user->id),
        ],
        'role' => ['required', 'exists:roles,name'],
        'password' => ['nullable', 'string', 'min:8', 'confirmed'],
    ]);

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
    ]);

    // Ubah password hanya jika kolom diisi
    if (!empty($validated['password'])) {
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);
    }

    // Perbarui role pengguna
    $user->syncRoles([$validated['role']]);

    return redirect()->route('admin.users.index')
        ->with('success', 'Data pengguna berhasil diperbarui.');
}


    // Menghapus pengguna
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Kamu tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
