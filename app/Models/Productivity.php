<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Productivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'member_id',
        'projectId',
        'subject',
        'description',
        'added_date',
        'start_time',
        'end_time',
        'time_rendered',
    ];

    protected $table = 'productivities';

    public function members(): BelongsTo
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }
}
