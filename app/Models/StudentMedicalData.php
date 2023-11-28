<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentMedicalData extends Model
{
    use HasFactory;

    /**
     * Get the student associated
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
