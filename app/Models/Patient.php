<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'family_id',
        'birthdate',
        'sex',
        'contact_number'
    ];

    public function family(){
        return $this->belongsTo(Family::class);
    }
}