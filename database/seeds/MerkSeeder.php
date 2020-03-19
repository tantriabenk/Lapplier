<?php

use Illuminate\Database\Seeder;

class MerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $merk = new \App\Merk;
        $merk->nama_merk = "Yamaha";
        $merk->slug = "yamaha";
        $merk->save();
        $this->command->info("Merk berhasil diinsert");
    }
}
