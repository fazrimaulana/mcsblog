<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        		"name" => "root",
        		"display_name" => "Root",
        		"description" => "Root"
        	]);

        DB::table('roles')->insert([
        		"name" => "administrator",
        		"display_name" => "Administrator",
        		"description" => "Administrator"
        	]);

        DB::table('roles')->insert([
        		"name" => "editor",
        		"display_name" => "Editor",
        		"description" => "Editor"
        	]);

        DB::table('roles')->insert([
        		"name" => "author",
        		"display_name" => "Author",
        		"description" => "Author"
        	]);

        DB::table('roles')->insert([
        		"name" => "contributor",
        		"display_name" => "Contributor",
        		"description" => "Contributor"
        	]);

        DB::table('roles')->insert([
        		"name" => "subscriber",
        		"display_name" => "Subscriber",
        		"description" => "Subscriber"
        	]);

    }
}
