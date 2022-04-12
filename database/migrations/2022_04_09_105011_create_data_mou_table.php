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
        Schema::create('data_mous', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->string('judul_mou');
            $table->string('bidang_kerjasama');
            $table->string('file_pdf');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->enum('status', ['Aktif', 'Expired']);
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
        Schema::dropIfExists('data_mous');
    }
};
