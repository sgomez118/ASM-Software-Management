
<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder

/* code for answersSeeder to seed the answers table */

 /**
 * Run the database seeds.
 *
 * @return void
 */
public function run()
{
    DB::table('answers')->insert([
        'text' => 'some test text' ,
        'image' => null]); 
}

?>


