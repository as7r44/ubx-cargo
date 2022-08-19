<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $get_cargos = "DROP PROCEDURE IF EXISTS `get_cargos`;
            CREATE PROCEDURE `get_cargos` ()
            BEGIN
            SELECT * FROM cargos;
            END;";
        
        $get_cargo = "DROP PROCEDURE IF EXISTS `get_cargo`;
            CREATE PROCEDURE `get_cargo` (IN idx int)
            BEGIN
            SELECT * FROM cargos WHERE id = idx;
            END;";
        
        \DB::unprepared($get_cargos);
        \DB::unprepared($get_cargo);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stored_procedures');
    }
}
