<?php

use Illuminate\Database\Seeder;

class user_sedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = ['Admin','Super Admin','User'];

        for($i=0;$i<count($name);$i++){
            $role = App\Role::create([
                'name'=> $name[$i],
                'slug'=> str_slug($name[$i])
            ]);

            $user = App\User::create([
                'name'=> $name[$i],
                'username'=> str_slug($name[$i]),
                'role_id'=> $role->id,
                'email'=> str_slug($name[$i])."@google.com",
                'password'=> Hash::make('rahasia'),
            ]);
        }
    }
}
