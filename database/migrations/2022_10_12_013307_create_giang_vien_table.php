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
            $table->id();
            $table->integer('id_user');
            $table->string('ten_giang_vien');
            $table->string('dia_chi')->nullable();
            $table->string('email');
            $table->text('sdt')->nullable();
            $table->string('hinh_anh')->nullable();
            $table->integer('gioi_tinh')->nullable();
            $table->string('mo_ta')->nullable();
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
        Schema::dropIfExists('giang_vien');
    }
};
