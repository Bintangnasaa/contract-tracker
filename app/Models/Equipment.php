<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';

    protected $fillable = ['name', 'category', 'stock'];

    public function loans()
    {
        return $this->hasMany(EquipmentLoan::class);
    }
}