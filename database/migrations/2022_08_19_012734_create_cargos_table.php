<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('type');
            $table->integer('size');
            $table->double('weight', 8, 2);
            $table->text('remarks')->nullable();
            $table->double('wharfage', 8, 2)->default(0.00);
            $table->integer('penalty')->default(0);
            $table->double('storage', 8, 2)->default(0.00);
            $table->double('electricity', 8, 2)->default(0.00);
            $table->double('destuffing', 8, 2)->default(0.00);
            $table->double('lifting', 8, 2)->default(0.00);
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
        Schema::dropIfExists('cargos');
    }
}
