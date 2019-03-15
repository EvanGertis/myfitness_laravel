<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Workout extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = [
        'user_id',
        'workout_id'
    ];
}