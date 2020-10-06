<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
class CreateTeamMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_member', function (Blueprint $table) {
            $table->foreignId('team_id')
                ->references('id')
                ->on('team')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreignId('user_id')
                ->references('id')
                ->on('user')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->primary(['team_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_member');
    }
}
