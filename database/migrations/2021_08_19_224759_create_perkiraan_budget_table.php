<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerkiraanBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perkiraan_budget', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_deal')->nullable();
            $table->string('jenis_perkiraan')->nullable();
            $table->string('nama_perkiraan')->nullable();
            $table->integer('nilai_perkiraan')->nullable();
            $table->datetime('tgl_post')->nullable();
            $table->string('jenis_penawaran')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('perkiraan_budget');
    }
}
