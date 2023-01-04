<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static $rules = [
        'task_name' => 'required|string|max:20',
        'description' => 'required|string|max:500',
        'status' => 'required|string',
        'deadline' => 'required|date|after_or_equal:today'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
