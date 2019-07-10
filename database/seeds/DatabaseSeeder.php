<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\Reply;
use App\Models\Like;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class,10)->create();
        factory(Category::class,10)->create();
        factory(Question::class,10)->create();

        factory(Reply::class, 10)
           ->create()
           ->each(function ($reply) {
                $reply->like()->save(factory(Like::class)->make());
            });
    }
}
