<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->q, function ($query, $q) {
            $query->where(function ($search) use ($q) {
                $search->where('name', 'like', "%{$q}%")
                    ->orWhere('username', 'like', "%{$q}%")
                    ->orWhere('nis', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username', 'unique:users,nis'],
            'nis' => [
                'exclude_if:role,admin',
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9]+$/',
                'unique:users,nis',
                'unique:users,username',
            ],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'in:admin,siswa'],
            'password' => ['required', 'string', 'min:8'],
        ], $this->messages());

        $validated['nis'] = $validated['role'] === 'siswa' ? ($validated['nis'] ?? null) : null;

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('status', 'Akun berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
                Rule::unique('users', 'nis')->ignore($user->id),
            ],
            'nis' => [
                'exclude_if:role,admin',
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9]+$/',
                Rule::unique('users', 'nis')->ignore($user->id),
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'role' => ['required', 'in:admin,siswa'],
            'password' => ['nullable', 'string', 'min:8'],
        ], $this->messages());

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($user->id === $request->user()->id) {
            $validated['role'] = $user->role;
        }

        $validated['nis'] = $validated['role'] === 'siswa' ? ($validated['nis'] ?? null) : null;

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('status', 'Akun berhasil diperbarui.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->withErrors(['user' => 'Akun yang sedang digunakan tidak dapat dihapus.']);
        }

        if ($user->loans()->exists()) {
            return back()->withErrors(['user' => 'Akun memiliki riwayat peminjaman dan tidak dapat dihapus.']);
        }

        if ($user->photo_path) {
            Storage::disk('public')->delete($user->photo_path);
        }

        $user->delete();

        return back()->with('status', 'Akun berhasil dihapus.');
    }

    private function messages(): array
    {
        return [
            'username.unique' => 'Username sudah digunakan sebagai username atau NIS akun lain.',
            'nis.unique' => 'NIS sudah digunakan sebagai NIS atau username akun lain.',
            'nis.regex' => 'NIS hanya boleh berisi angka.',
        ];
    }
}