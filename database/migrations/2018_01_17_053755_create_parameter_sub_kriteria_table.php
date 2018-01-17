<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParameterSubKriteriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameter_sub_kriteria', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_parameter');
            $table->string('nilai');
            $table->integer('id_subkriteria')->unsigned();
            $table->foreign('id_subkriteria')
                  ->references('id')->on('sub_kriteria')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('parameter_sub_kriteria');
    }
}
