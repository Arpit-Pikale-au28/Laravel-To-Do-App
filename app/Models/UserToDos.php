<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserToDos extends Model
{
    protected $table = 'user_to_dos';

    protected $fillable = [
        'user_id',
        'todo_text',
        'reminder_date',
        'created_date',
    ];
}
