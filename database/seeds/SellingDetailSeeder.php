<?php

use Illuminate\Database\Seeder;

class SellingDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $selling = new \App\SellingDetail;
        $selling->selling_id = 1;
        $selling->product_id = 1;
        $selling->price_sell = 100000;
        $selling->qty = 1;
        $selling->total = 100000;
        $selling->discount = 5000;
        $selling->save();
        $this->command->info("Selling detail berhasil diinsert");
    }
}
