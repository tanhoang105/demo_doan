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
        Schema::create('xep_lop', function (Blueprint $table) {
            $table->id();
            $table->date('ngay_dang_ky');
            $table->integer('id_lop');
            $table->integer('id_user');
            $table->integer('id_ca_hoc');
            $table->integer('id_phong_hoc');
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
        Schema::dropIfExists('xep_lop');
    }
};
