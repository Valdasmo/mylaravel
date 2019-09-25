<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,100) as $val){
    DB::table('masters')->insert([
    
    'name'=> $faker->firstNameFemale(),
    'surname'=> $faker->lastName(),
    // 'file'=> ''
]);
    }
    }
}
