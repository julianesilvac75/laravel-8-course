<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_no_blog_posts_when_nothing_on_the_database()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No blog posts yet!');
    }

    public function test_see_one_blog_post_when_there_is_one()
    {
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'This is the content';
        $post->save();

        $response = $this->get('/posts');

        $response->assertSeeText('New title');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }
}
