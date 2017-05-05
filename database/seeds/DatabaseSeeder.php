<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SettingsGeneralSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FrontpageTableSeeder::class);
        $this->call(PostTableSeeder::class);
        $this->call(PageTableSeeder::class);

    }
}
