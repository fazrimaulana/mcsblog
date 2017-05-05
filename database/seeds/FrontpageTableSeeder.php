<?php

use Illuminate\Database\Seeder;

class FrontpageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('frontpage')->insert([
        		"name" => "About",
        		"content" => "About"
        	]);


        $datas = array('email' => "it@mcs.co.id", 'noTelepon' => "021-80624624", 'address' => "Jalan Mampang Prapatan 15b, Duren Tiga, Pancoran, Kota Jakarta Selatan, DKI Jakarta 12760");

		$json = json_encode($datas);

        DB::table('frontpage')->insert([
        		"name" => "Contact",
        		"content" => $json
        	]);

    }
}
