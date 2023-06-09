<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'lastname' => Str::random(10),
            'username' => Str::random(10),
            'email' => 'catureque+'.Str::random(3).'@gmail.com',
            'password' => Hash::make('password'),
        ]);

       

    }
}