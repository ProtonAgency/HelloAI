<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;

class CreateArtificalIntelligencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artifical_intelligences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('type')->nullable();
            $table->string('name');
            // $table->binary('export');
            $table->string('identifier');
            $table->timestamps();
        });

        // no `LONGBLOB` in the schema builder :/
        DB::statement("ALTER TABLE artifical_intelligences ADD export LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artifical_intelligences');
    }
}
