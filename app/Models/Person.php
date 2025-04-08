<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['task_id', 'title', 'name','gender', 'job', 'level'];


    public function people()
    {
        return $this->hasMany(\App\Models\Person::class);
    }

}
