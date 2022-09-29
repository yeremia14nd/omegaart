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
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'username' => 'superadmin',
            'address' => 'Jl. Cimahi 1 No. 7, Malang',
            'phoneNumber' => '08523445567',
            'password' => bcrypt('password'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'address' => 'Jl. Cilembu 1 No. 7, Malang',
            'phoneNumber' => '08983774333992',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Estimator',
            'email' => 'estimator@gmail.com',
            'username' => 'estimator',
            'address' => 'Jl. Apel No. 12, Malang',
            'phoneNumber' => '08983774333992',
            'password' => bcrypt('password'),
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Teknisi',
            'email' => 'teknisi@gmail.com',
            'username' => 'teknisi',
            'address' => 'Jl. Sayur No. 4, Malang',
            'phoneNumber' => '085948222944',
            'password' => bcrypt('password'),
            'role_id' => 4,
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
        Product::create([
            'category_id' => 2,
            'product_availability_id' => 1,
            'name' => 'Roller Blinds',
            'slug' => 'roller-blinds',
            'excerpt' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores magnam quam, praesentium nulla voluptatum ratione?',
            'price' => 1250000,
            'workDuration' => 14,
            'weight' => 2,
            'stock' => 50,
            'description' => 'Vestibulum vitae orci ac nisl dictum sagittis. Fusce eleifend scelerisque est sed tempor. Proin accumsan tristique metus, at consequat augue laoreet vestibulum. Ut consectetur ex turpis, et aliquam nunc euismod at. Nullam non dignissim urna, in ultricies nulla. Donec eget massa ex. Duis eget laoreet magna. Praesent iaculis nunc at quam congue, venenatis viverra ex posuere. Curabitur at lorem efficitur, facilisis massa non, dignissim ex. Etiam risus risus, dapibus eu scelerisque eget, volutpat et ipsum. Ut viverra ullamcorper ex ut lobortis. Aenean non aliquet ante. Fusce suscipit vestibulum massa et viverra. Vestibulum vel rutrum dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;',
            'imageAssets' => 'product-images/sofa1a.png',
        ]);
        Cart::factory(5)->create();
        CartItem::factory(15)->create();
    }
}
