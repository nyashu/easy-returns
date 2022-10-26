<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;



class StoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = User::factory(10)->create()->each(function ($closure) {
            $closure->store()->create([
                'website' => 'https://www.example.com',
                'type' =>  array_rand(['furnitures', 'electronics', 'fashions', 'automobiles']),
            ]);
        });

        $images = File::allFiles(resource_path() . '/img/stores');
        foreach ($stores as $store)
            $store->addMedia(Arr::random($images, 1)[0]->getPathname())->preservingOriginal()->toMediaCollection('profile');
    }
}
