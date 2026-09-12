<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable(['user_id', 'trainer_name', 'booking_date', 'booking_time', 'status'])]
class TrainerBooking extends Model
{
    //
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
