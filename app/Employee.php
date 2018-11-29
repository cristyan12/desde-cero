<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function journal()
    {
        return $this->belongsTo(Journal::class, 'journal_type');
    }
}
