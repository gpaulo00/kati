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
        Schema::table('students', function (Blueprint $table) {
            $table->string('nivel_educacion')->nullable();
            $table->string('periodo_escolar')->nullable();
            $table->string('tipo_educacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('nivel_educacion');
            $table->dropColumn('periodo_escolar');
            $table->dropColumn('tipo_educacion');
        });
    }
};
