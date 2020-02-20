<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    protected $table = 'statments';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
