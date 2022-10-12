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
            $table->integer('id_khoa_hoc');
            $table->string('ten_lop');
            $table->decimal('gia')->nullable();
            $table->integer('so_luong')->nullable(); //số lượng học viên lớp
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
            $table->integer('id_giang_vien');
            $table->integer('id_co_so');
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
