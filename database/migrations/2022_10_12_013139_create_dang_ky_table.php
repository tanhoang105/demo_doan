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
        Schema::create('dang_ky', function (Blueprint $table) {
            $table->id();
            $table->date('ngay_dangky');
            $table->integer('id_thanhtoan');
            $table->decimal('gia');
            $table->integer('id_lop');
            $table->integer('id_user');
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
        Schema::dropIfExists('dang_ky');
    }
};
