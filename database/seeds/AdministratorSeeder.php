<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->username = "administrator";
        $administrator->name = "Site Administrator";
        $administrator->email = "administrator@supplier.test";
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->password = \Hash::make("rahasia");
        $administrator->avatar = "";
        $administrator->address = "Denpasar";
        $administrator->phone = "0819381232";
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
