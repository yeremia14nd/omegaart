<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductAvailability;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'name' => 'superadmin',
        ]);
        Role::create([
            'name' => 'admin',
        ]);
        Role::create([
            'name' => 'estimator',
        ]);
        Role::create([
            'name' => 'teknisi',
        ]);
        Role::create([
            'name' => 'customer',
        ]);
        User::create([
            'name' => 'Yeremia Nd',
            'email' => 'yerind@gmail.com',
            'username' => 'yeremiand',
            'address' => 'Jl. Pendekar 1 No. 7, Malang',
            'phoneNumber' => '081122334455',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Alicia',
            'email' => 'alicia@gmail.com',
            'username' => 'alicia',
            'address' => 'Jl. Lestari 1 No. 7, Surabaya',
            'phoneNumber' => '085544332212',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        User::factory(10)->create();


        ProductAvailability::create([
            'availability' => 'Available Now'
        ]);

        ProductAvailability::create([
            'availability' => 'Need Survey'
        ]);

        Category::create([
            'name' => 'Sofa',
            'slug' => 'sofa',
            'imageAssets' => 'product-images/sofa1a.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores magnam quam, praesentium nulla voluptatum ratione?'
        ]);
        Category::create([
            'name' => 'Blinds',
            'slug' => 'blind',
            'imageAssets' => 'product-images/sofa1a.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores magnam quam, praesentium nulla voluptatum ratione?'
        ]);
        Category::create([
            'name' => 'Aluminium',
            'slug' => 'aluminium',
            'imageAssets' => 'product-images/sofa1a.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores magnam quam, praesentium nulla voluptatum ratione?'
        ]);

        Product::factory(20)->create();
        // Order::factory(5)->create();
        // OrderItem::factory(40)->create();
        Cart::factory(5)->create();
        CartItem::factory(15)->create();
    }
}
