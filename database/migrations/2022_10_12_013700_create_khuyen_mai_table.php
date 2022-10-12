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
        Schema::create('khuyen_mai', function (Blueprint $table) {
            $table->id();
            $table->string('ma_khuyenmai');
            $table->string('loai_khuyenmai');
            $table->string('mo_ta');
            $table->integer('giam_gia');
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
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
        Schema::dropIfExists('khuyen_mai');
    }
};
