<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
class CreateTaskUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_user', function (Blueprint $table) {
            $table->foreignId('task_id')
                ->references('id')
                ->on('task')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->foreignId('user_id')
                ->references('id')
                ->on('user')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->primary(['task_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_user');
    }
}
