<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->truncate();

      DB::table('categories')->insert([
          'title' => "Body parts"
      ]);

      DB::table('categories')->insert([
          'title' => "Tires"
      ]);
    }
}
