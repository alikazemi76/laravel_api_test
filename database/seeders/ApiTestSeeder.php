<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ApiTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createCate('varzishi');
        $cate2= $this->createCate('science');
        $cate=$this->createCate('fun');
        $cate4=$this->createCate('programming');

        $tag1= $this->createTag('laravel');
        $tag2= $this->createTag('fotbal');
        $tag3= $this->createTag('mysql');
        $tag4= $this->createTag('php');
        $tag5= $this->createTag('ball');
        $tag6= $this->createTag('game');
        $tag7= $this->createTag('math');
        $tag8= $this->createTag('fish');


        $user = new User();
        $user->name = 'kazemi';
        $user->email = 'ali@ali.com2';
        $user->password = Hash::make('1234');
        $user->save();

        $post = new Post();
        $post->title = 'new Post';
        $post->body = 'this is a new post for test app';
        $post->user_id = $user->id;
        $post->category_id = $cate4->id;
        $post->save();
        $post->tags()->attach([$tag1->id,$tag3->id,$tag4->id]);

        $post2 = new Post();
        $post2->title = 'new Post';
        $post2->body = 'this is a new post for fun';
        $post2->user_id = $user->id;
        $post2->category_id = $cate->id;
        $post2->save();
        $post2->tags()->attach([$tag5->id,$tag6->id]);

        $post3 = new Post();
        $post3->title = 'new Post';
        $post3->body = 'this is a new post for science';
        $post3->user_id = $user->id;
        $post3->category_id = $cate2->id;
        $post3->save();
        $post3->tags()->attach([$tag7->id,$tag8->id]);
    }

    public function createCate($name)
    {
        $model = new Category();
        $model->name = $name;
        $model->save();
        return $model;
    }

    public function createTag($name)
    {
        $model = new Tag();
        $model->name = $name;
        $model->save();
        return $model;
    }
}
