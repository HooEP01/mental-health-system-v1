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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            /* start foreign key */
            $table->string('professional_id',5);
            /* end foreign key */
            $table->string('type', 100);
            $table->string('category', 100);
            $table->string('image')->nullable();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->boolean('is_approve');
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
        Schema::dropIfExists('contents');
    }
};
