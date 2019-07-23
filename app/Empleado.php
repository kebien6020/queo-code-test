<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{

    protected $fillable = ['first_name', 'last_name', 'email', 'phone'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'company_id');
    }

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
