<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Seller;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::truncate();
        Seller::truncate();
        Division::truncate();
        District::truncate();
        // Coupon::truncate();
        User::truncate();

        $this->call([
            AdminsTableSeeder::class,
            SellersTableSeeder::class,
            DivisionSeeder::class,
            DistrictSeeder::class,
            // CouponSeeder::class
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@gmail.com',
            'phone' => '01722260010',
            "isVerified" => 1,
            'password' => Hash::make('password'),
        ]);

        User::factory(10)->create();
        Seller::factory(50)->create();
        Slider::factory(8)->create();
        Brand::factory(20)->create();
        Category::factory(30)->create();
        SubCategory::factory(100)->create();
        Product::factory(100)->create();


    }
}
