<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class FlashSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Catégories
        |--------------------------------------------------------------------------
        */

        $categories = [
            [
                'name' => 'Tabac',
                'slug' => 'tabac',
                'description' => 'Produits du tabac disponibles au Flash.',
                'icon' => '🚬',
            ],
            [
                'name' => 'Confiserie',
                'slug' => 'confiserie',
                'description' => 'Bonbons, chewing-gums et petites douceurs.',
                'icon' => '🍬',
            ],
            [
                'name' => 'Boissons',
                'slug' => 'boissons',
                'description' => 'Boissons fraîches et énergisantes.',
                'icon' => '🥤',
            ],
            [
                'name' => 'Presse',
                'slug' => 'presse',
                'description' => 'Journaux et magazines.',
                'icon' => '📰',
            ],
            [
                'name' => 'Jeux',
                'slug' => 'jeux',
                'description' => 'Jeux et produits de loterie disponibles en point de vente.',
                'icon' => '🎟️',
            ],
            [
                'name' => 'Accessoires',
                'slug' => 'accessoires',
                'description' => 'Accessoires disponibles au Flash.',
                'icon' => '🔥',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                [
                    'name' => $categoryData['name'],
                    'description' => $categoryData['description'],
                    'icon' => $categoryData['icon'],
                    'active' => true,
                ]
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Produits
        |--------------------------------------------------------------------------
        */

        $tabac = Category::where('slug', 'tabac')->firstOrFail();
        $confiserie = Category::where('slug', 'confiserie')->firstOrFail();
        $boissons = Category::where('slug', 'boissons')->firstOrFail();
        $accessoires = Category::where('slug', 'accessoires')->firstOrFail();

        $products = [
            [
                'category_id' => $tabac->id,
                'name' => 'Produit tabac - Exemple',
                'slug' => 'produit-tabac-exemple',
                'description' => 'Produit de démonstration à remplacer par le produit réel.',
                'price' => 10.00,
                'stock' => 20,
                'image' => null,
                'active' => true,
                'age_restricted' => true,
            ],
            [
                'category_id' => $confiserie->id,
                'name' => 'Chewing-gum',
                'slug' => 'chewing-gum',
                'description' => 'Chewing-gum.',
                'price' => 1.50,
                'stock' => 30,
                'image' => null,
                'active' => true,
                'age_restricted' => false,
            ],
            [
                'category_id' => $confiserie->id,
                'name' => 'Bonbons',
                'slug' => 'bonbons',
                'description' => 'Sachet de bonbons.',
                'price' => 2.50,
                'stock' => 25,
                'image' => null,
                'active' => true,
                'age_restricted' => false,
            ],
            [
                'category_id' => $boissons->id,
                'name' => 'Boisson fraîche',
                'slug' => 'boisson-fraiche',
                'description' => 'Boisson fraîche.',
                'price' => 2.00,
                'stock' => 20,
                'image' => null,
                'active' => true,
                'age_restricted' => false,
            ],
            [
                'category_id' => $boissons->id,
                'name' => 'Boisson énergisante',
                'slug' => 'boisson-energisante',
                'description' => 'Boisson énergisante.',
                'price' => 3.00,
                'stock' => 20,
                'image' => null,
                'active' => true,
                'age_restricted' => false,
            ],
            [
                'category_id' => $accessoires->id,
                'name' => 'Briquet',
                'slug' => 'briquet',
                'description' => 'Briquet.',
                'price' => 2.50,
                'stock' => 15,
                'image' => null,
                'active' => true,
                'age_restricted' => false,
            ],
        ];

        foreach ($products as $productData) {
            Product::updateOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );
        }
    }
}
