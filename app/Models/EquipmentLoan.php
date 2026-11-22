<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentLoan extends Model
{
    protected $fillable = [
        'content_id', 'user_id', 'equipment_id', 'qty', 'borrow_date', 'return_date', 'status'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}