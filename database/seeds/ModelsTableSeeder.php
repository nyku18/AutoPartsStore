<?php

use Illuminate\Database\Seeder;

class ModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('car_models')->truncate();

      DB::table('car_models')->insert([
          'brand_id' => 1,
          'name' => "A4"
      ]);

      DB::table('car_models')->insert([
          'brand_id' => 1,
          'name' => "Q5"
      ]);

      DB::table('car_models')->insert([
          'brand_id' => 2,
          'name' => "320"
      ]);

      DB::table('car_models')->insert([
          'brand_id' => 2,
          'name' => "525"
      ]);

      DB::table('car_models')->insert([
          'brand_id' => 3,
          'name' => "C180"
      ]);

      DB::table('car_models')->insert([
          'brand_id' => 3,
          'name' => "S63"
      ]);

      DB::table('car_models')->insert([
          'brand_id' => 4,
          'name' => "Golf"
      ]);

      DB::table('car_models')->insert([
          'brand_id' => 4,
          'name' => "Passat"
      ]);
    }
}
