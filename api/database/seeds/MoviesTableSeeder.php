<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
}
