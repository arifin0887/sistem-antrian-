<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'queue_id',
        'doctor_id',
        'anamnesis',
        'physical_exam',
        'diagnosis',
        'therapy',
        'notes',
    ];

public function queue(): BelongsTo
    {
        return $this->belongsTo(\App\Models\queue::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}

