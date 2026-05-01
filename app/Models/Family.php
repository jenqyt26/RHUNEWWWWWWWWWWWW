<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = ['family_name', 'barangay_id', 'family_number'];

    public function barangay(){
        return $this->belongsTo(Barangay::class);
    }

    public function patients(){
        return $this->hasMany(Patient::class);
    }
}