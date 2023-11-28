<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_medical_data', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_sangre')->nullable();
            $table->string('alergias')->nullable();
            $table->string('discapacidad')->nullable();
            $table->string('enfermedad')->nullable();

            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_medical_data');
    }
};
