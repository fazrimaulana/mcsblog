<?php

use Illuminate\Database\Seeder;

class SettingsGeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        DB::table('settings')->insert([
        		"setting_name"  => "site_title",
        		"setting_value" => "Maxindo Content Solution"
        	]);

        DB::table('settings')->insert([
        		"setting_name"  => "tagline",
        		"setting_value" => "Moto situs Anda bisa diletakkan disini"
        	]);

        DB::table('settings')->insert([
        		"setting_name"  => "site_url",
        		"setting_value" => "/"
        	]);

        DB::table('settings')->insert([
        		"setting_name"  => "home_url",
        		"setting_value" => "/home"
        	]);

        DB::table('settings')->insert([
        		"setting_name"  => "email_address",
        		"setting_value" => "fm.fazri.m@gmail.com"
        	]);

        DB::table('settings')->insert([
        		"setting_name"  => "membership",
        		"setting_value" => "true"
        	]);

        DB::table('settings')->insert([
        		"setting_name"  => "default_role",
        		"setting_value" => "6"
        	]);

    }
}
