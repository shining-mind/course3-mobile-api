<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
class CreateTaskTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_team', function (Blueprint $table) {
            $table->foreignId('task_id')
                ->references('id')->on('task')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreignId('team_id')
                ->references('id')
                ->on('team')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->primary(['task_id', 'team_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_team');
    }
}
