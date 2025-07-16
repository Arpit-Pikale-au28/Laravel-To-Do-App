<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    * Run the migrations.
    */
    public function up()
    {
        Schema::create('user_to_dos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');   
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('todo_text')->nullable();
            $table->date('reminder_date')->nullable();
            $table->date('created_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_to_dos');
    }
};
