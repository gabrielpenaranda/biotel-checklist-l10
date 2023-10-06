<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('checklist_number');
            $table->text('notes');
            $table->text('instructions');
            /*
            No asignado => 0
            En proceso => 1
            Verificado => 2
            */

            $table->enum('status', ['0', '1', '2'])->default('0');
             /*
            No Verificado => 0
            1ra verificacion => 1
            2da verificacion => 2
            */
            $table->enum('verificacion', ['0','1', '2'])->default('0');
            $table->foreignId('employee_id')->references('id')->on('users');
            $table->foreignId('supervisor_id')->references('id')->on('users');
            $table->string('name_first');
            $table->string('name_second');
            $table->datetime('first_date');
            $table->datetime('second_date');
            $table->datetime('expiration');
            $table->integer('days')->unsigned()->default(0);
            $table->integer('hours')->unsigned()->default(0);
            $table->integer('minutes')->unsigned()->default(0);
            $table->boolean('expired')->default(false);
            $table->boolean('enabled')->default(true);
            $table->enum('priority', ['Inmediata', 'Urgente', 'Alta', 'Intermedia', 'Baja']);
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
        Schema::dropIfExists('checklists');
    }
}
