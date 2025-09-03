<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

     protected $fillable = ["name","color"];

    protected $casts = [
        'color' => 'string'
    ];

    
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'category_task_pivots');
    }

    public function scopeForTasks($query,$userId){
        return $query->whereHas('tasks',function ($query) use ($userId){
            return $query->parent()->forUser($userId);
        });
    }
}
