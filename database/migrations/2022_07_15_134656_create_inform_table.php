<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('inform', function (Blueprint $table) {
        //     $table->id(); 
        //     $table->text('messages');
        //     $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
        //     $table->dateTime('deadline');
        //     $table->boolean('status')->default(0);
        //     $table->timestamps();
        // });

        // Schema::create('user_progress', function (Blueprint $table) {
        //     $table->id(); 
        //     $table->foreignId('inform_id')->constrained('inform')->onUpdate('cascade')->onDelete('cascade');
        //     $table->string('uri')->nullable();
        //     $table->string('note', 190);
        //     $table->boolean('status')->default(0);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informs');
        Schema::dropIfExists('user_progess');
    }
};
