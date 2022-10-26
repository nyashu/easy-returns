<?php

namespace Database\Seeders;

use App\Models\EasyReturn;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([UsersTableSeeder::class]);
        $user_admin = User::create([
            'name' => 'Admin Easy Return',
            'email' => 'admin@gmail.com',
            'role_id' => User::ADMIN,
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
            'phone' => "+619812818656",
            'address' => 'Sydney, Australia'
        ]);

        $user_admin->addMedia(resource_path() . '/img/avatar.png')->preservingOriginal()->toMediaCollection('profile');

        $user_user1 = User::create([
            'name' => 'Zabeen Shrestha',
            'email' => 'zabeen@gmail.com',
            'role_id' => User::USER,
            'password' => bcrypt('zabeen'),
            'email_verified_at' => now(),
            'phone' => "+619812818656",
            'address' => 'Melbourne , Australia'
        ]);

        $user_user1->addMedia(resource_path() . '/img/avatar.png')->preservingOriginal()->toMediaCollection('profile');

        $user_userR = User::create([
            'name' => 'Sam Smith',
            'email' => 'sam@gmail.com',
            'role_id' => User::USER,
            'password' => bcrypt('sam'),
            'email_verified_at' => now(),
            'phone' => "+619812818656",
            'address' => 'Melbourne , Australia'
        ]);

        $user_userR->addMedia(resource_path() . '/img/avatar.png')->preservingOriginal()->toMediaCollection('profile');

        $user_user2 = User::create([
            'name' => 'Amazon',
            'email' => 'amazon@gmail.com',
            'role_id' => User::STORE,
            'password' => bcrypt('amazon'),
            'email_verified_at' => now(),
            'phone' => "+619812818656",
            'address' => '53 Mnimbah Road, Fingal Bay'
        ]);

        $user_user2->store()->create([
            'website' => 'https://www.amazon.com.au',
            'type' => 'fashions'
        ]);

        $user_user2->addMedia(Arr::random(File::allFiles(resource_path() . '/img/stores/amazon'), 1)[0]->getPathname())->preservingOriginal()->toMediaCollection('profile');

        $user_store = User::create([
            'name' => 'Ebay',
            'email' => 'store@gmail.com',
            'role_id' => User::STORE,
            'password' => bcrypt('store'),
            'email_verified_at' => now(),
            'phone' => "+619812818656",
            'address' => '74 Plantation Place, New South Wales'
        ]);

        $user_store->store()->create([
            'website' => 'https://www.ebay.com.au',
            'type' => 'electronics'
        ]);

        $user_store->addMedia(Arr::random(File::allFiles(resource_path() . '/img/stores/ebay'), 1)[0]->getPathname())->preservingOriginal()->toMediaCollection('profile');

        $user_store1 = User::create([
            'name' => 'Ali Express',
            'email' => 'aliexpress@gmail.com',
            'role_id' => User::STORE,
            'password' => bcrypt('aliexpress'),
            'email_verified_at' => now(),
            'is_verified' => false,
            'phone' => "+619812818656",
            'address' => 'Corella, Queensland'
        ]);

        $user_store1->store()->create([
            'website' => 'https://www.aliexpress.com.au',
            'type' => 'furnitures'
        ]);

        $user_store1->addMedia(Arr::random(File::allFiles(resource_path() . '/img/stores/google'), 1)[0]->getPathname())->preservingOriginal()->toMediaCollection('profile');

        $user_store2 = User::create([
            'name' => 'Etsy',
            'email' => 'etsy@gmail.com',
            'role_id' => User::STORE,
            'password' => bcrypt('etsy'),
            'email_verified_at' => now(),
            'is_verified' => false,
            'phone' => "+619810000000",
            'address' => 'Collerina, New South Wales'
        ]);

        $user_store2->store()->create([
            'website' => 'https://www.etsy.com.au',
            'type' => 'electronics'
        ]);

        $user_store2->addMedia(Arr::random(File::allFiles(resource_path() . '/img/stores/etsy'), 1)[0]->getPathname())->preservingOriginal()->toMediaCollection('profile');

        $user_store3 = User::create([
            'name' => 'Catch',
            'email' => 'catch@gmail.com',
            'role_id' => User::STORE,
            'password' => bcrypt('catch'),
            'email_verified_at' => now(),
            'is_verified' => false,
            'phone' => "+619810000000",
            'address' => 'Copperhannia, New South Wales'
        ]);

        $user_store3->store()->create([
            'website' => 'https://www.catch.com.au',
            'type' => 'fashions'
        ]);

        $user_store3->addMedia(Arr::random(File::allFiles(resource_path() . '/img/stores/catch'), 1)[0]->getPathname())->preservingOriginal()->toMediaCollection('profile');

        $user_store4 = User::create([
            'name' => 'MyDeal',
            'email' => 'mydeal@gmail.com',
            'role_id' => User::STORE,
            'password' => bcrypt('mydeal'),
            'email_verified_at' => now(),
            'is_verified' => false,
            'phone' => "+619810000000",
            'address' => 'Fingal Bay, New South Wales'
        ]);

        $user_store4->store()->create([
            'website' => 'https://www.mydeal.com.au',
            'type' => 'electronics'
        ]);

        $user_store4->addMedia(Arr::random(File::allFiles(resource_path() . '/img/stores/mydeal'), 1)[0]->getPathname())->preservingOriginal()->toMediaCollection('profile');

        User::factory()->count(1500)->create()->each(function ($user) {
            $user->addMedia(Arr::random(File::allFiles(resource_path() . '/img/users'), 1)[0]->getPathname())->preservingOriginal()->toMediaCollection('profile');
        });


        EasyReturn::factory()->count(10000)->create();
        // ->each(function ($return) {
        //     $return->addMedia(Arr::random(File::allFiles(resource_path() . '/img/returns'), 1)[0]->getPathname())->preservingOriginal()->toMediaCollection('return');
        // });
        // $this->call([
        //     StoresSeeder::class
        // ]);
    }
}
