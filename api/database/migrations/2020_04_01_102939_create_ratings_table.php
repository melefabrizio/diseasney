<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('movie_id');

            $table->decimal('overall',3,1);
            $table->decimal('score',3,1);
            $table->decimal('animation',3,1);
            $table->decimal('universe',3,1);
            $table->decimal('story',3,1);
            $table->decimal('bad_guy',3,1);
            $table->decimal('good_guy',3,1);

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
        Schema::dropIfExists('ratings');
    }
}
