<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
class CreateSubTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')
                ->references('id')
                ->on('task')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('restrict');
            $table->string('name', 255);
            $table->text('description');
            $table->timestamps();
            $table->dateTime('finished_at')->nullable()->default(null);
            $table->dateTime('deadline')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_task');
    }
}
