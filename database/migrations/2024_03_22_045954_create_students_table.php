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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->string('full_name', 55);
            $table->unsignedBigInteger('strand_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('teacher_id');
            $table->string('student_id_no', 55)->unique();
            $table->string('password', 255);
            $table->timestamps();

            $table->foreign('strand_id')
                ->references('strand_id')
                ->on('strands')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('section_id')
                ->references('section_id')
                ->on('sections')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('teacher_id')
                ->references('teacher_id')
                ->on('teachers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
