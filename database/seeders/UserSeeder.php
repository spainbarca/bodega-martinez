<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = Role::create(['name' => 'admin']);

        User::create([
            'name' => 'Noah Martinez Hancco',
            'email' => 'spain.barcelona.1999@gmail.com',
            'password' => Hash::make('Ecommerce2021@')
        ])->assignRole('admin');


        User::factory(20)->create();
    }
}
