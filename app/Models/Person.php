<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['name', 'age', 'distance'];

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function likes()
    {
        return $this->interactions()->where('type', 'like');
    }
}
