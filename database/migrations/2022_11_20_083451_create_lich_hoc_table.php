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
        Schema::create('lich_hoc', function (Blueprint $table) {
            $table->id();
            $table->date('ngay_hoc');
            $table->integer('lop_id');
            $table->integer('ma_thu');
            $table->integer('ca_id');
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
        Schema::dropIfExists('lich_hoc');
    }
};
