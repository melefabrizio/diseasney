<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('original_title');
            $table->string('year');
            $table->string('animation');
            $table->string('link')->nullable();
            $table->timestamps();
        });

        $csvfile = base_path().'/app/disney.csv';
        $header=true;

        if (($handle = fopen ( $csvfile, 'r' )) !== FALSE) {
            while ( ($data = fgetcsv ( $handle, 1000, ';' )) !== FALSE ) {
                print_r($data);
                if ( $header ) {
                    $header = false;
                }
                else{
                        $movie = array(
                            'title' => $data[0],
                            'original_title' => $data[1],
                            'year' => $data[2],
                            'animation' => $data[3]
                        );
                        DB::table('movies')->insert($movie);

                }
            }
            fclose ( $handle );
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
