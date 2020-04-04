<?php

use Illuminate\Database\Seeder;

class SellingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $selling = new \App\Selling;
        $selling->nota_number = "TP0001";
        $selling->date = "2019-07-20";
        $selling->total_selling = 100000;
        $selling->customer_id = 1;
        $selling->save();
        $this->command->info("Selling berhasil diinsert");
    }
}
