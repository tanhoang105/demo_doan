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
        Schema::create('thanh_toan', function (Blueprint $table) {
            $table->id();
            $table->integer('phuong_thuc_thanh_toan');
            $table->date('ngay_thanh_toan');
            $table->decimal('gia');
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
        Schema::dropIfExists('thanh_toan');
    }
};
