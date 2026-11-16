<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public const LOAN_DAYS = 7;

    public const FINE_PER_DAY = 1000;

    public const MAX_EXTENSIONS = 1;

    public const EXTENSION_DAYS = 7;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'loan_date',
        'approved_at',
        'handed_over_at',
        'due_date',
        'returned_at',
        'extension_count',
        'extended_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'loan_date' => 'date',
            'approved_at' => 'datetime',
            'handed_over_at' => 'date',
            'due_date' => 'date',
            'returned_at' => 'date',
            'extension_count' => 'integer',
            'extended_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function fine()
    {
        return $this->hasOne(Fine::class);
    }

    public function extensionError(): ?string
    {
        if ($this->status !== 'dipinjam' || $this->due_date === null) {
            return 'Hanya buku yang sedang dipinjam yang dapat diperpanjang.';
        }

        if ($this->due_date->lt(now()->startOfDay())) {
            return 'Peminjaman sudah melewati jatuh tempo dan tidak dapat diperpanjang.';
        }

        if ((int) $this->extension_count >= self::MAX_EXTENSIONS) {
            return 'Batas perpanjangan sudah tercapai.';
        }

        return null;
    }

    public function canExtend(): bool
    {
        return $this->extensionError() === null;
    }

    public function extend(): void
    {
        $this->update([
            'due_date' => $this->due_date->copy()->addDays(self::EXTENSION_DAYS),
            'extension_count' => (int) $this->extension_count + 1,
            'extended_at' => now(),
        ]);
    }
}