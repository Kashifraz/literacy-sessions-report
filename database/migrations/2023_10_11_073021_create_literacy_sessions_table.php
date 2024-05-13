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
        Schema::create('literacy_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->integer('attendees')->nullable();
            $table->text('participants')->nullable();
            $table->string('identity')->nullable();
            $table->string("campus")->nullable();
            $table->string("topic")->nullable();
            $table->string("department")->nullable();
            $table->string("program")->nullable();
            $table->string("conductedby")->nullable();
            $table->string('images')->nullable();
            $table->text('answers')->nullable();
            $table->date('sessiondate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('literacy_sessions');
    }
};
