<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['title', 'description', 'start_date', 'end_date', 'status'];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }
}