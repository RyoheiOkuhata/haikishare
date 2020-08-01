<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  
    //factoryメソッドの第二引数に指定した分のダミーデータが生まれます。
        $products = factory(Product::class, 10)->create();
    }
}
