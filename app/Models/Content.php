<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'campaign_id', 'title', 'platform', 'script_link', 'asset_link', 'status', 'deadline'
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}