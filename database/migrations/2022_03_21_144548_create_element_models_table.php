<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_models', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('element_number')->unsigned();
            $table->integer('level')->default(0)->unsigned();
            $table->foreignId('checklist_model_id')->references('id')->on('checklist_models')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('element_models');
    }
}
