<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('car_brands')->truncate();

      DB::table('car_brands')->insert([
          'name' => "Audi"
      ]);

      DB::table('car_brands')->insert([
          'name' => "BMW"
      ]);

      DB::table('car_brands')->insert([
          'name' => "Mercedes-Benz"
      ]);

      DB::table('car_brands')->insert([
          'name' => "Volkswagen"
      ]);
    }
}
