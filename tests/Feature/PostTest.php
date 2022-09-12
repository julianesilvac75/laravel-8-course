<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
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

    public function test_see_one_blog_post_when_there_is_one_with_no_comments()
    {
        $post = $this->createDummyBlogPost();

        $response = $this->get('/posts');

        $response->assertSeeText('New title');
        $response->assertSeeText('No comments yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New title'
        ]);
    }

    public function test_see_one_blog_post_when_there_is_one_with_comments()
    {
        $post = $this->createDummyBlogPost();
        Comment::factory(4)->create([
            'blog_post_id' => $post->id
        ]);

        $response = $this->get('/posts');

        $response->assertSeeText('4 comments');
    }

    public function test_store_valid()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'This is a valid content'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        
        $this->assertEquals(session('status'), 'The blog post was created!');
    }

    public function test_store_fail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x',
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function test_update_valid()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title' => 'Modified title',
            'content' => 'This is the modified content',
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was updated!');

        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        $this->assertDatabaseHas('blog_posts', $params);
    }

    public function test_delete()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'The blog post was deleted!');
        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
    }

    private function createDummyBlogPost(): BlogPost
    {
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'This is the content';
        $post->save();

        return $post;
    }
}
