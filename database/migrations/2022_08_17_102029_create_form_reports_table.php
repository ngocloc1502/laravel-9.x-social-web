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
        Schema::create('form_reports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('table');
            $table->string('post_id');
            $table->text('content')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

        Schema::create('post_reports', function (Blueprint $table) {
            $table->string('report_id')->constrained('user_report')->onUpdate('cascade')->onDelete('cascade');
            $table->string('form_id')->constrained('form_reports')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_reports');
    }
};
