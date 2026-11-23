<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
#[Fillable(['title', 'description', 'event_date_time', 'location', 'category', 'status', 'capacity', 'user_id'])]
class Event extends Model
{
    use SoftDeletes;   //

    public const categories = [
        'Academic',
        'Sports',
        'Community Service',
        'Arts & Culture',
        'Social',
        'Career & Professional',
    ];

    public const statuses = [
        'Upcoming',
        'Ongoing',
        'Completed',
        'Cancelled',
    ];

    protected function casts(): array
    {
        return ['event_date_time' => 'datetime'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withTrashed();
    }



}
