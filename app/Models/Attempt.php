<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'attempt'
    ];

    public function result()
    {
        return $this->hasMany('App\Model\Result', 'attempt')->where('user_id', '=', $this->user_id);
    }
}
