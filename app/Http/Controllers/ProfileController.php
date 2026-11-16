<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    private const PHOTO_MAX_MESSAGE = 'Ukuran foto melebihi 2 MB. Penggantian foto dibatalkan.';

    public function edit(Request $request)
    {
        $view = $request->user()->role === 'admin' ? 'admin.profile' : 'siswa.profile';
        return view($view, ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return back()->with('status', 'Profil berhasil diperbarui.');
    }

    public function showPhoto(Request $request, User $user)
    {
        $viewer = $request->user();

        abort_unless($viewer->role === 'admin' || $viewer->id === $user->id, 403);

        $disk = Storage::disk('public');

        if (!$user->photo_path || !$disk->exists($user->photo_path)) {
            abort(404);
        }

        return $disk->response($user->photo_path, null, [
            'Cache-Control' => 'private, max-age=86400',
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $file = $request->file('photo');

        if ($file && !$file->isValid()) {
            $sizeErrors = [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE];

            return back()->withErrors([
                'photo' => in_array($file->getError(), $sizeErrors, true)
                    ? self::PHOTO_MAX_MESSAGE
                    : 'Foto gagal diunggah. Penggantian foto dibatalkan.',
            ]);
        }

        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'photo.required' => 'Pilih foto terlebih dahulu.',
            'photo.image' => 'Berkas harus berupa gambar.',
            'photo.mimes' => 'Format foto harus JPG, PNG, atau WEBP.',
            'photo.max' => self::PHOTO_MAX_MESSAGE,
            'photo.uploaded' => self::PHOTO_MAX_MESSAGE,
        ]);

        $user = $request->user();
        $oldPath = $user->photo_path;

        $newPath = $request->file('photo')->store('profile-photos', 'public');

        if (!$newPath) {
            return back()->withErrors([
                'photo' => 'Foto gagal disimpan di server. Penggantian foto dibatalkan.',
            ]);
        }

        $user->update(['photo_path' => $newPath]);

        if ($oldPath && $oldPath !== $newPath) {
            Storage::disk('public')->delete($oldPath);
        }

        return back()->with('status', 'Foto profil berhasil diperbarui.');
    }

    public function destroyPhoto(Request $request)
    {
        $user = $request->user();

        if ($user->photo_path) {
            Storage::disk('public')->delete($user->photo_path);
            $user->update(['photo_path' => null]);
        }

        return back()->with('status', 'Foto profil dihapus. Inisial username ditampilkan kembali.');
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update(['password' => Hash::make($validated['password'])]);

        return back()->with('status', 'Password berhasil diubah.');
    }
}