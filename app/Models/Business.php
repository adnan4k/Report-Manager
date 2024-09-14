<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with Document
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Define the relationship with Report
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
