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
        Schema::create('hoc_vien', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('ten_hoc_vien');
            $table->string('dia_chi')->nullable();
            $table->string('email')->unique();
            $table->integer('sdt')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->integer('gioi_tinh')->nullable();
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
        Schema::dropIfExists('hoc_vien');
    }
};
