<?php

namespace App\Database\Seeds;

use App\Models\ProductModel;
use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run()
    {

        helper('text');

        for($num=0;$num<10;$num++){
            $product = new ProductModel();

            $insertdata['product'] = random_string('alpha', 15);
            $insertdata['category'] = random_string('alpha', 10);
            $insertdata['price'] = rand(50, 20000);
            $insertdata['sku'] = rand(25,40);
            $insertdata['model'] = rand(1, 100);

            $product->insert($insertdata);
       }
  }
}
