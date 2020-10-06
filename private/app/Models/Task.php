<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';

    protected $fillable = [
        'name', 'description', 'deadline'
    ];

    protected $casts = [
        'finished_at' => 'datetime',
        'deadline' => 'datetime',
    ];

    /**
     * Users which have access to the task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }

    /**
     * Teams which have access to the task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'task_team');
    }

    /**
     * Sub tasks
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }
}
