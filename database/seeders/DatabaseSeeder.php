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
            'role_id' => 5,
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
            'imageAssets' => 'product-images/rollerblinds.jpg',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores magnam quam, praesentium nulla voluptatum ratione?'
        ]);
        Category::create([
            'name' => 'Aluminium',
            'slug' => 'aluminium',
            'imageAssets' => 'product-images/aluminium.jpg',
            'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maiores magnam quam, praesentium nulla voluptatum ratione?'
        ]);

        Product::create([
            'category_id' => 1,
            'product_availability_id' => 1,
            'name' => 'Sofa 2-Seater',
            'slug' => 'sofa-2-seater',
            'excerpt' => 'Sofa nyaman untuk hunian anda, sofa ini dapat diatur sesuai keinginan anda untuk diletakkan di ruangan manapun',
            'price' => 2000000,
            'workDuration' => 7,
            'weight' => 50,
            'stock' => 12,
            'description' => 'Sofa ini dapat diatur sesuai keinginan Anda untuk diletakkan di ruang manapun di rumah. Dengan jumlah 2 dudukan, desain, dan sesuaikan dengan fungsi ruangannya. Saat keluarga atau rumah Anda tumbuh, tambahkan lagi dudukannya dan biarkan kursi sofa minimalis ini juga ikut tumbuh bersama Anda. Temukan berbagai kursi sofa terlengkap dan lihat juga model sofa tamu minimalis terbaru berikut sesuai dengan keinginan Anda.',
            'imageAssets' => 'product-images/sofa1a.png',
        ]);
        Product::create([
            'category_id' => 2,
            'product_availability_id' => 2,
            'name' => 'Roller Blinds',
            'slug' => 'roller-blinds',
            'excerpt' => 'Roller blinds untuk jendela kaca anda. Blinds dengan kain yang mampu memblokir sinar UV. Variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan,',
            'price' => 1250000,
            'workDuration' => 14,
            'weight' => 2,
            'stock' => 50,
            'description' => 'Blinds dengan kain yang mampu memblokir sinar UV. Variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan. Roller blinds menambah keindahan bagi rumah anda. Roller blinds dengan kain yang mampu memblokir cahaya hingga 100%, kain indoor berkualitas dan variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan, Roller blinds menambah keindahan bagi jendela rumah anda',
            'imageAssets' => 'product-images/rollerblinds.jpg',
        ]);
        Product::create([
            'category_id' => 1,
            'product_availability_id' => 1,
            'name' => 'Sofa 3-Seater',
            'slug' => 'sofa-3-seater',
            'excerpt' => 'Sofa nyaman untuk hunian anda, sofa ini dapat diatur sesuai keinginan anda untuk diletakkan di ruangan manapun',
            'price' => 2500000,
            'workDuration' => 7,
            'weight' => 50,
            'stock' => 12,
            'description' => 'Sofa ini dapat diatur sesuai keinginan Anda untuk diletakkan di ruang manapun di rumah. Dengan jumlah 3 dudukan, desain, dan sesuaikan dengan fungsi ruangannya. Saat keluarga atau rumah Anda tumbuh, tambahkan lagi dudukannya dan biarkan kursi sofa minimalis ini juga ikut tumbuh bersama Anda. Temukan berbagai kursi sofa terlengkap dan lihat juga model sofa tamu minimalis terbaru berikut sesuai dengan keinginan Anda.',
            'imageAssets' => 'product-images/sofa1b.png',
        ]);
        Product::create([
            'category_id' => 2,
            'product_availability_id' => 2,
            'name' => 'Roller Blinds Outdoor',
            'slug' => 'roller-blinds-outdoor',
            'excerpt' => 'Roller blinds untuk outdoor. Blinds dengan kain yang mampu memblokir sinar UV. Variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan,',
            'price' => 1000000,
            'workDuration' => 14,
            'weight' => 2,
            'stock' => 50,
            'description' => 'Blinds dengan kain yang mampu memblokir sinar UV. Variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan. Roller blinds menambah keindahan bagi rumah anda. Roller blinds dengan kain yang mampu memblokir cahaya hingga 100%, kain indoor berkualitas dan variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan, Roller blinds menambah keindahan bagi jendela rumah anda',
            'imageAssets' => 'product-images/rollerblindout.jpg',
        ]);
        Product::create([
            'category_id' => 1,
            'product_availability_id' => 1,
            'name' => 'Sofa 4-Seater',
            'slug' => 'sofa-4-seater',
            'excerpt' => 'Sofa nyaman untuk hunian anda, sofa ini dapat diatur sesuai keinginan anda untuk diletakkan di ruangan manapun',
            'price' => 3500000,
            'workDuration' => 7,
            'weight' => 60,
            'stock' => 12,
            'description' => 'Sofa ini dapat diatur sesuai keinginan Anda untuk diletakkan di ruang manapun di rumah. Dengan jumlah 4 dudukan, desain, dan sesuaikan dengan fungsi ruangannya. Saat keluarga atau rumah Anda tumbuh, tambahkan lagi dudukannya dan biarkan kursi sofa minimalis ini juga ikut tumbuh bersama Anda. Temukan berbagai kursi sofa terlengkap dan lihat juga model sofa tamu minimalis terbaru berikut sesuai dengan keinginan Anda.',
            'imageAssets' => 'product-images/sofa1a.png',
        ]);
        Product::create([
            'category_id' => 2,
            'product_availability_id' => 2,
            'name' => 'Roller Blinds Regular',
            'slug' => 'roller-blinds-regular',
            'excerpt' => 'Roller blinds untuk jendela kaca anda. Blinds dengan kain yang mampu memblokir sinar UV. Variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan,',
            'price' => 1250000,
            'workDuration' => 14,
            'weight' => 2,
            'stock' => 50,
            'description' => 'Blinds dengan kain yang mampu memblokir sinar UV. Variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan. Roller blinds menambah keindahan bagi rumah anda. Roller blinds dengan kain yang mampu memblokir cahaya hingga 100%, kain indoor berkualitas dan variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan, Roller blinds menambah keindahan bagi jendela rumah anda',
            'imageAssets' => 'product-images/rollerblinds.jpg',
        ]);
        Product::create([
            'category_id' => 1,
            'product_availability_id' => 1,
            'name' => 'Sofa 2-Seater 1',
            'slug' => 'sofa-2-seater-1',
            'excerpt' => 'Sofa nyaman untuk hunian anda, sofa ini dapat diatur sesuai keinginan anda untuk diletakkan di ruangan manapun',
            'price' => 2700000,
            'workDuration' => 7,
            'weight' => 55,
            'stock' => 10,
            'description' => 'Sofa ini dapat diatur sesuai keinginan Anda untuk diletakkan di ruang manapun di rumah. Dengan jumlah 2 dudukan, desain, dan sesuaikan dengan fungsi ruangannya. Saat keluarga atau rumah Anda tumbuh, tambahkan lagi dudukannya dan biarkan kursi sofa minimalis ini juga ikut tumbuh bersama Anda. Temukan berbagai kursi sofa terlengkap dan lihat juga model sofa tamu minimalis terbaru berikut sesuai dengan keinginan Anda.',
            'imageAssets' => 'product-images/sofa1b.png',
        ]);
        Product::create([
            'category_id' => 2,
            'product_availability_id' => 2,
            'name' => 'Roller Blinds Outdoor Reg',
            'slug' => 'roller-blinds-outdoor-reg',
            'excerpt' => 'Roller blinds untuk outdoor. Blinds dengan kain yang mampu memblokir sinar UV. Variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan,',
            'price' => 1400000,
            'workDuration' => 14,
            'weight' => 4,
            'stock' => 20,
            'description' => 'Blinds dengan kain yang mampu memblokir sinar UV. Variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan. Roller blinds menambah keindahan bagi rumah anda. Roller blinds dengan kain yang mampu memblokir cahaya hingga 100%, kain indoor berkualitas dan variasi warna beragam, dengan sistem tarikan roller yang praktis dan mudah digunakan, Roller blinds menambah keindahan bagi jendela rumah anda',
            'imageAssets' => 'product-images/rollerblindout.jpg',
        ]);
        Product::factory(5)->create();

        Cart::factory(5)->create();
        CartItem::factory(15)->create();
    }
}
