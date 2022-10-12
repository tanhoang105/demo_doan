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
        Schema::create('lop', function (Blueprint $table) {
            $table->id();
            $table->integer('id_khoahoc');
            $table->string('ten_lop');
            $table->decimal('gia');
            $table->integer('so_luong'); //số lượng học viên lớp
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->integer('id_giangvien');
            $table->integer('id_coso');
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
        Schema::dropIfExists('lop');
    }
};
