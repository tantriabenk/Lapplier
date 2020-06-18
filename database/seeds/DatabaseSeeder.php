<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdministratorSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(MerkSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SupplierSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
