<?php

namespace Database\Seeders;

use App\Models\Rarity;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesRaritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Weapon',
            'Armor',
            'Consumable',
            'Material',
            'Miscellaneous'
        ];

        foreach ($types as $type) {
            Type::create(['name' => $type]);
        }

        $rarities = [
            'Common',
            'Uncommon',
            'Rare',
            'Epic',
            'Legendary'
        ];

        foreach ($rarities as $rarity) {
            Rarity::create(['name' => $rarity]);
        }
    }
}
