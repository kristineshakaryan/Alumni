<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $category = new Category;
        $category->title = 'Student';
        $category->color = '#e67f44';
        $category->save();

        $category = new Category;
        $category->title = 'Alumni';
        $category->color = '#20a8d8';
        $category->save();

        $category = new Category;
        $category->title = 'Teacher';
        $category->color = '#f86c6b';
        $category->save();

        $category = new Category;
        $category->title = 'School admin';
        $category->color = '#ffc107';
        $category->save();
    }
}
