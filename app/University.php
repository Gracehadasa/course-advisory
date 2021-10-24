<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;


class University extends Model
{
    use Rateable;
    protected $fillable = [
        'name', 'email','phone'
    ];
}
