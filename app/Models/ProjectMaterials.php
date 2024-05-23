<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMaterials extends Model
{
    use HasFactory;


    protected $table = 'project_materials';
    protected $fillable = [
        'project_id',
        'item_name',
        'quantity',
        'total_price',
        'unit',
        'category_section',
    ];
}
