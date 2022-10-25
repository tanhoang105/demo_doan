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
        Schema::create('ca_hoc', function (Blueprint $table) {
            $table->id();
            $table->string('ca_hoc');
<<<<<<< HEAD
            $table->time('thoi_gian');
=======
            $table->time('thoi_gian')->nullable();
>>>>>>> 75b82c4db2706fe87f11db77073ec081b99dd3cb
            $table->integer('trang_thai')->default(1);
            $table->integer('delete_at')->default(1);
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
        Schema::dropIfExists('ca_hoc');
    }
};
