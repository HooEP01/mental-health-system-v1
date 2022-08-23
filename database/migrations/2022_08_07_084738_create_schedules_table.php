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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            /*start foreign key */
            $table->string('event_id', 10);
            /*end foreign key */
            $table->string('periodical', 10); /*daily, weekly, biweekly, monthly */
            $table->string('day', 4); /* 1,2,3,4,5 */
            $table->dateTime('start_datetime', $precision = 0);
            $table->dateTime('end_datetime', $precision = 0);
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
        Schema::dropIfExists('schedules');
    }
};
