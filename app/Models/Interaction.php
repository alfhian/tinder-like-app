<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $fillable = ['person_id', 'type'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
