<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            // $table->string('nama');
            $table->string('keterangan');
            $table->string('kegiatan');
            $table->string('image');
            $table->bigInteger('siswas_id')->unsigned();
            $table->timestamps();
            $table->foreign('siswas_id')->references('id')->on('siswas')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
}
