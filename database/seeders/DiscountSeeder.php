<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discount;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discounts = [
            [
                'name' => 'Daily Subscriber',
                'percentage'=> 5
            ],
            [
                'name' => 'Monthly Subscriber',
                'percentage'=> 10
            ]
         ];
       
         foreach ($discounts as $discount) {
              Discount::create([
                'name' => $discount['name'],
                'percentage' => $discount['percentage']
            ]);
         }
    }
}
