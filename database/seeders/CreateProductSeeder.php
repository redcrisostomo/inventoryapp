<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Animal & Pet Supplies",
            "Apparel & Accessories",
            "Arts & Entertainments",
            "Baby & Toddler",
            "Business & Industrial",
            "Cameras & Optics",
            "Electronics",
            "Food, Beverages & Tobacco",
            "Furniture",
            "Hardware",
            "Health & Beauty",
            "Home & Garden",
            "Luggage & Bags",
            "Mature",
            "Media",
            "Office Supplies",
            "Religious & Ceremonial",
            "Software",
            "Sporting Goods",
            "Toys & Games",
            "Vehicles & Parts",
            "Weapons",
            "Gift Cards"
        ];
        /**Loop through each category and create record */
        foreach($categories as $category)
        {
            Category::create(['name' => $category]);
        }

        /**setup products */
        $products = [
            [
                'name' => 'Cabbage Kimchi',
                'description' => '500g chopped cabbage kimchi',
                'category' => 'Food, Beverages & Tobacco',
                'date_available' => now(),
            ],
            [
                'name' => 'Royal Canin Adult Urinary Care Dry Cat Food',
                'description' => 'Royal Canin Feline Care Nutrition Adult Urinary Care Dry Cat Food 2kg',
                'category' => 'Animal & Pet Supplies',
                'date_available' => now(),
            ],
        ];

        /**loop through each product */
        foreach($products as $rowp)
        {
            $cat = $rowp['category'];
            unset($rowp['category']);


            if(!empty($cat)) /**if category is not empty */
            {
                /**look for category or create */
                $category = Category::firstOrCreate(['name'=>$cat]);
                $rowp['category_id'] = $category->id;
            }
            $product = Product::create($rowp); /**create product record */
        }
    }
}
