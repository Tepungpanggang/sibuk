<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $activeLoans = $user->loans()->where('status', 'dipinjam')->count();
        $pendingLoans = $user->loans()->where('status', 'pending')->count();
        $totalFine = $user->loans()
            ->whereHas('fine', fn($query) => $query->where('status', 'unpaid'))
            ->with('fine')
            ->get()
            ->sum(fn($loan) => $loan->fine->amount ?? 0);

        $recentLoans = $user->loans()->with(['book', 'fine'])->latest()->take(5)->get();

        $notifications = $user->loans()
            ->with('book')
            ->whereIn('status', ['approved', 'rejected'])
            ->latest('updated_at')
            ->take(5)
            ->get();

        $guideVideoUrl = $this->guideVideoUrl();

        return view('siswa.dashboard', compact(
            'activeLoans',
            'pendingLoans',
            'totalFine',
            'recentLoans',
            'notifications',
            'guideVideoUrl'
        ));
    }

    private function guideVideoUrl(): ?string
    {
        $relative = (string) config('sibuk.guide_video_path');

        if ($relative === '') {
            return null;
        }

        $path = Storage::disk('local')->path($relative);

        if (!is_file($path)) {
            return null;
        }

        return route('guide.video', ['v' => filemtime($path)]);
    }
}