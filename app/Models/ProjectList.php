<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectList extends Model
{
    use HasFactory;
    protected $tablle = 'project_lists';
    protected $fillable = [
        'manager_id',
        'project_name',
        'project_type',
        'category',
        'category_type',
        'total_budget',
        'project_owner',
        'description',
        'project_location_text',
        'project_location_codes',
        'status',
        'start_date',
        'end_date',
    ];



    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'project_owner', 'id');
    }

    public function getTotalPercentageAttribute(): int
    {
        return $this->tasks()->where('status', 'Done')->sum('percentage');
    }


    public function members(): HasMany
    {
        return $this->hasMany(ProjectMembers::class, 'project_id', 'id');
    }


    public function tasks(): HasMany
    {
        return $this->hasMany(TaskList::class, 'project_id', 'id');
    }

    public function totalCost(): BelongsTo
    {
        return $this->belongsTo(ProjectMaterials::class, 'project_id', 'id');
    }
}
