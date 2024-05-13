<?php

use App\Models\LiteracySession;
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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LiteracySession::class);
            $table->string('title');
            $table->integer('order_id');
            $table->integer('strongly_agree');
            $table->integer('agree');
            $table->integer('disagree');
            $table->integer('strongly_disagree');
            $table->integer('no_response');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
