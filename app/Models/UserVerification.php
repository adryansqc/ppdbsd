<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage; // Import Storage

class UserVerification extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the user that owns the UserVerification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($userVerification) {
            if ($userVerification->bukti_pembayaran) {
                Storage::disk('public')->delete($userVerification->bukti_pembayaran);
            }
        });

        static::updating(function ($userVerification) {
            if ($userVerification->isDirty('bukti_pembayaran') && ($oldFile = $userVerification->getOriginal('bukti_pembayaran'))) {
                Storage::disk('public')->delete($oldFile);
            }
        });
    }
}
