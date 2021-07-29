<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        Category::create([
            'name' => 'Laptop' ,
            'slug' => 'laptop',
        ]);
        Category::create([
            'name' => 'TV' ,
            'slug' => 'tv',
        ]);
        Category::create([
            'name' => 'Tablet' ,
            'slug' => 'tablet',
        ]);
        Category::create([
            'name' => 'Phone' ,
            'slug' => 'phone',
        ]);
        Category::create([
            'name' => 'Desktop' ,
            'slug' => 'desktop',
        ]);
        Category::create([
            'name' => 'Camera' ,
            'slug' => 'camera',
        ]);
        Category::create([
            'name' => 'Appliance' ,
            'slug' => 'appliance',
        ]);
    }
}
