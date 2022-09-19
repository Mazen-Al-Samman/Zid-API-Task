<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FillCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function up()
    {
        $categories = [
            [
                'label' => ['ar' => 'موبايل وتابلت', 'en' => 'Mobiles & Tablets'],
                'description' => ['ar' => 'كل ما يتعلق بـ الأجهزة الذكية', 'en' => 'All about Mobiles & Tablets']
            ],
            [
                'label' => ['ar' => 'إلكترونيات', 'en' => 'Electronics'],
                'description' => ['ar' => 'كل ما يتعلق بـ الإلكترونيات', 'en' => 'All About Electronics']
            ],
            [
                'label' => ['ar' => 'ألعاب فيديو', 'en' => 'Gaming'],
                'description' => ['ar' => 'كل ما يتعلق بألعاب الفيديو', 'en' => 'All About Gaming']
            ],
            [
                'label' => ['ar' => 'سيارات', 'en' => 'Cars'],
                'description' => ['ar' => 'كل ما يتعلق بالسيارات', 'en' => 'All About Cars']
            ],
            [
                'label' => ['ar' => 'كمبيوتر ولابتوب', 'en' => 'Computer & Laptop'],
                'description' => ['ar' => 'كل ما يتعلق بالأجهزة المحمولة', 'en' => 'All About Computers & Laptops']
            ]
        ];

        foreach ($categories as $category) {
            $categoryModel = new Category();
            $categoryModel->label = $category['label'];
            $categoryModel->description = $category['description'];
            if (!$categoryModel->save()) throw new Exception("Can't save category model !");
            echo "Saved" . PHP_EOL;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
