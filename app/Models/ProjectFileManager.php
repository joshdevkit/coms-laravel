<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectFileManager extends Model
{
    use HasFactory;

    protected $table = 'project_file_managers';
    protected  $fillable = [
        'project_id',
        'user_id',
        'file_name',
        'file_text',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
