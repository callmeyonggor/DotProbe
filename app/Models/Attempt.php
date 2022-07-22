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
        'attempt',
        'total_correct',
        'total_incongruents',
        'total_congruents',
        'avg_response',
        'avg_incongruent_response',
        'avg_congruent_response',
    ];

    public function result()
    {
        return $this->hasMany('App\Model\Result', 'attempt')->where('user_id', '=', $this->user_id);
    }
}
