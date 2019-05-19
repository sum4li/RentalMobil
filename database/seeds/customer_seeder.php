<?php

use Illuminate\Database\Seeder;

class customer_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();


        for($i=0;$i<1000;$i++){
            App\Customer::create([
                'name'=> $faker->name,
                'nik'=> $faker->ssn,
                'address'=> $faker->address,
                'sex'=> $faker->randomElement(['laki-laki','perempuan']),
                'slug'=> str_slug($faker->name),
                'phone_number'=> $faker->phoneNumber,
                'email'=> $faker->email
            ]);
        }
    }
}
