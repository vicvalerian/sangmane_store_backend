<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@gmail.com')->first();

        $vendor = new Vendor();
        $vendor->banner = 'uploads/123.jpg';
        $vendor->shop_name = 'Admin Shop Seeder';
        $vendor->phone = '123123123';
        $vendor->email = 'admin@gmail.com';
        $vendor->address = 'Indo';
        $vendor->description = 'shop description';
        $vendor->user_id = $user->id;

        $vendor->save();
    }
}
