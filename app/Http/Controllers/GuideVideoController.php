<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class GuideVideoController extends Controller
{
    public function show()
    {
        $relative = (string) config('sibuk.guide_video_path');
        $path = Storage::disk('local')->path($relative);

        abort_unless($relative !== '' && is_file($path), 404);

        $mimeTypes = [
            'mp4' => 'video/mp4',
            'webm' => 'video/webm',
            'ogv' => 'video/ogg',
        ];

        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return response()->file($path, [
            'Content-Type' => $mimeTypes[$extension] ?? 'application/octet-stream',
            'Cache-Control' => 'private, max-age=86400',
        ]);
    }
}