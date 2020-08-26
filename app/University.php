<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'universities';

    protected $fillable = [
        'name', 'state-province', 'alpha_two_code','country','web_pages','domains'
    ];
}
