<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier = new \App\Supplier;
        $supplier->name = "PT Ban Cahaya";
        $supplier->phone_number = "089231823";
        $supplier->address = "Jalan Raya Lombok";
        $supplier->status = "Active";
        $supplier->save();

        $supplier = new \App\Supplier;
        $supplier->name = "Default";
        $supplier->phone_number = "-";
        $supplier->address = "-";
        $supplier->status = "Active";
        $supplier->save();

        $this->command->info("Supplier berhasil diinsert");
    }
}
