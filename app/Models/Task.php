<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // protected $fillable = ['title', 'description'];
    protected $fillable = [
        'title',
        'description',
        'ref',
        'by',
        'startdate',
        'enddate',
        'datesign',
        'spp'
    ];

    


    public function people()
    {
        return $this->hasMany(\App\Models\Person::class);
    }
}


