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
        Schema::create('giang_vien', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('ten_giangvien');
            $table->string('dia_chi');
            $table->string('email');
            $table->integer('sdt');
            $table->integer('gioi_tinh');
            $table->integer('trang_thai')->default(1);
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
        Schema::dropIfExists('giang_vien');
    }
};
