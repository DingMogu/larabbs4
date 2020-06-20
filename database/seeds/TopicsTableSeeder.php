<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Topic;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        //获取所以用户的ID数组
        $user_ids = User::all()->pluck('id')->toArray();
        //获取所有分类的ID数组
        $category_ids = Category::all()->pluck('id')->toArray();

        //获取faker实例
        $faker = app(Faker\Generator::class);

        //生成话题
        $topics = factory(Topic::class)
                    ->times(100)
                    ->make()
                    ->each(function ($topic, $index)
                        use($user_ids, $category_ids, $faker)
                    {
                        //从用户ID数组中随机取出一个并赋值
                       $topic->user_id = $faker->randomElement($user_ids);
                       //话题分类 同上
                       $topic->category_id = $faker->randomElement($category_ids);
                    });
        Topic::insert($topics->toArray());
    }

}

