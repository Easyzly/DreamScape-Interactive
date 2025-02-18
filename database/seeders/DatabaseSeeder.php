<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesPermissionSeeder::class);
        $this->call(TypesRaritiesSeeder::class);
        $this->call(ItemsSeeder::class);

        $admin = User::factory()->create([
            'name' => 'Jamie vg',
            'email' => 'jamievangulik2006@gmail.com',
        ]);
        $admin->assignRole('Beheerder');

        $randomItems = Item::inRandomOrder()->limit(10)->get();
        $randomItems->each(function ($item) use ($admin) {
            $admin->items()->attach($item, ['quantity' => rand(1, 5)]);
        });
    }
}
