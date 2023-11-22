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
            //
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
        });

        Schema::table('user', function (Blueprint $table) {
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
            $table->dropColumn('telefono');
            $table->dropColumn('correo');
            $table->dropColumn('direccion');
        });

        Schema::table('user', function (Blueprint $table) {
            //
            $table->dropColumn('telefono');
            $table->dropColumn('correo');
            $table->dropColumn('direccion');
        });
    }
};
