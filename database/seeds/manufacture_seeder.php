<?php

use Illuminate\Database\Seeder;

class manufacture_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Toyota','Suzuki','Honda','Mercedes-Benz','BMW','Daihatsu','Nissan','Isuzu','KIA','Mitsubishi','Datsun','Mazda','Hyundai','Chevrolet'];
        arsort($name);

        for($i=0;$i<count($name);$i++){
            App\Manufacture::create([
                'name'=> $name[$i],
                'slug'=> str_slug($name[$i]),
            ]);
        }
    }
}
