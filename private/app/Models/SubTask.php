<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;

    protected $table = 'sub_task';

    protected $fillable = [
        'name', 'description', 'deadline'
    ];

    protected $casts = [
        'finished_at' => 'datetime',
        'deadline' => 'datetime',
    ];

    /**
     * Task to which sub task belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
