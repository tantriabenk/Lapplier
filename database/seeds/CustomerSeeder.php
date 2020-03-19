<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = new \App\Customer;
        $customer->name = "Joko";
        $customer->store_name = "Toko Nusantara";
        $customer->phone_number = "089231823";
        $customer->status = "Active";
        $customer->save();
        $this->command->info("Customer berhasil diinsert");
    }
}
