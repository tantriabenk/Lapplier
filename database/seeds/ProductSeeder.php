<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product;
        $product->product_name = "Spion";
        $product->stock = 10;
        $product->status = "Active";
        $product->price_buy = 100000;
        $product->price_sell = 120000;
        $product->save();

        $product = new \App\Product;
        $product->product_name = "Ban";
        $product->stock = 10;
        $product->status = "Active";
        $product->price_buy = 200000;
        $product->price_sell = 250000;
        $product->save();

        $this->command->info("Product berhasil diinsert");
    }
}
