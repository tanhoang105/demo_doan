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
            $table->string('ma_khuyen_mai');
            $table->string('loai_khuyen_mai');
            $table->string('mo_ta')->nullable();
            $table->integer('giam_gia');
            $table->date('ngay_bat_dau');
            $table->date('ngay_ket_thuc');
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
        Schema::dropIfExists('khuyen_mai');
    }
};
