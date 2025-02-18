<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Sting',
            'Andúril',
            'Glamdring',
            'Narsil',
            'Orcrist',
            'Mithril Armor',
            'The One Ring',
            'Palantír',
            'Phial of Galadriel',
            'Horn of Gondor',
            'Elven Cloak',
            'Arkenstone',
            'Black Arrow',
            'Gondorian Shield',
            'Rohan Helm',
            'Hobbit Pipe',
            'Elven Bow',
            'Dwarven Axe',
            'Ranger Sword',
            'Witch-king’s Mace',
            'Valyrian Steel Sword',
            'Dragonglass Dagger',
            'Iron Throne',
            'Hand of the King Pin',
            'Three-Eyed Raven’s Staff',
            'Direwolf Pelt',
            'Wildfire',
            'Dragon Egg',
            'Golden Crown',
            'Faceless Mask',
            'Maester’s Chain',
            'Night’s Watch Cloak',
            'Red Priestess Necklace',
            'Unsullied Spear',
            'Dothraki Arakh',
            'Lannister Shield',
            'Stark Banner',
            'Targaryen Banner',
            'Baratheon Antlers',
            'Greyjoy Kraken',
            'Tyrell Rose',
            'Martell Sun',
            'Arryn Falcon',
            'Tully Fish',
            'Bolton Flayed Man',
            'Hound’s Helm',
            'Mountain’s Armor',
            'Littlefinger’s Dagger',
            'Brienne’s Sword',
        ];

        foreach ($items as $item) {
            Item::factory()->create(['name' => $item]);
        }
    }
}
