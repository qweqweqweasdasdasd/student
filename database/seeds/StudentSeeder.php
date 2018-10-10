<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('zh_CN');
        for ($i=0; $i < 2000; $i++) { 
        	\DB::table('student')->insert([
        		'std_name'=>$faker->name,
        		'password'=>bcrypt('123456'),
        		'std_email'=>$faker->email,
        		'std_birthday'=>$faker->dateTimeBetween('-30 years','-18 years'),
        		'std_phone'=>$faker->phoneNumber,
        		'std_sex'=>'男',
        		'std_pic'=>$faker->imageUrl(),
        		'std_desc'=>$faker->catchPhrase,
        	]);
        }
    }
}
