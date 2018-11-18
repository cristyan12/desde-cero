<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'last_name', 'document_identity', 'profession_id', 'email', 'cell_phone', 'home_phone', 'position_id'
    ];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
