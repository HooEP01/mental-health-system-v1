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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            /*Start foreign key*/
            $table->string('professional_id', 5);
            /*End foreign key*/
            $table->string('type', 30);
            $table->string('attendance_quantity', 5);
            $table->string('amount', 10)->default('free');
            $table->string('image', 255)->nullable();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->boolean('is_approve')->default(false);
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
        Schema::dropIfExists('events');
    }
};
