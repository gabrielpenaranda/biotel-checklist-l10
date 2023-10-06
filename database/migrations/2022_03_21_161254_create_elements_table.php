<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checklist_id')->references('id')->on('checklists')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('level')->unsigned();
            $table->boolean('column_one')->default(false);
            $table->tinytext('column_two');
            $table->boolean('column_three')->default(false);
            $table->tinytext('column_four');
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
        Schema::dropIfExists('elements');
    }
}
