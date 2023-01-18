<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->comment('ユーザーID');
            $table->string('name', 100)->charset("utf8")->index()->comment('レシピ名');
            $table->text('url')->comment('レシピURL');
            $table->string('comment')->nullable()->comment('コメント');
            $table->string('task')->default('OFF')->comment('レシピタスク(ON/OFF)');
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
        Schema::dropIfExists('recipes');
    }
}
