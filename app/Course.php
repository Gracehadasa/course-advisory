<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Course extends Model
{
    use Rateable;
    protected $casts = [
        'universities' => 'array'
    ];

    public function detail() {
        return $this->hasOne(Detail::class);
    }
}
