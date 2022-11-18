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
        Schema::create('doi_lop_khoa', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_lop_cu');
            $table->integer('id_lop_moi');
            $table->string('ly_do');
            $table->integer('status');
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
        Schema::dropIfExists('doi_lop_khoa');
    }
};
