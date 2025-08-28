<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{

     /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'create_date',
        'dead_line',
        'status',
        'end_flag',
        'parentTask_id'
    ];

    // This means that when fetching task
    // Laravel will auto convert these fields into php types
    protected $casts = [
        'create_date' => 'datetime',
        'dead_line' => 'date',
        'end_flag' => 'boolean'
    ];

    // These functions are essential to tell the relations to Elequent

    // Gathering and getting all paernt tasks attributes
    public function parentTask(): BelongsTo{
        return $this->belongsTo(Task::class,'parentTask_id');
    }

    // Gathering and getting all sub tasks attributes
    public function subTask(): HasMany{
        return $this->hasMany(Task::class,'parentTask_id');
    }

    // Accessing user table
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_task_pivots');
    }

    // Accessing categories table
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'category_task_pivots');
    }

}
