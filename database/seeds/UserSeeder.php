<?php

use Illuminate\Database\Seeder;

use App\User;
use Modules\Users\Models\Usermeta;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Fazri Maulana";
        $user->email = "fm.fazri.m@gmail.com";
        $user->password = bcrypt("123456");
        $user->api_token = md5("Fazri Maulana fm.fazri.m@gmail.com".date('Y-m-d H:i:s'));

        $user->save();

        Usermeta::create([
        		"user_id" => $user->id,
        		"display_name" => "Fazri",
        		"description" => "Developer",
        		"image" => null
        	]);

        $user->roles()->attach(['1']);

    }
}
