<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiPostCommentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_blog_post_does_not_have_comments()
    {
        BlogPost::factory()->create([
            'user_id' => $this->user()->id,
        ]);

        $response = $this->json('GET', 'api/v1/posts/1/comments');

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'links', 'meta'])
            ->assertJsonCount(0, 'data');
    }

    public function test_blog_post_has_10_comments()
    {
        BlogPost::factory()->create([
            'user_id' => $this->user()->id,
        ])->each(function (BlogPost $post) {
            $post->comments()->saveMany(
                Comment::factory(10)->make([
                    'user_id' => $this->user()->id
                ])
            );
        });

        // refreshDatabase will delete the previous post, and the post created on this test will have the id 2
        $response = $this->json('GET', 'api/v1/posts/2/comments');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    // each element inside 'data' has to have this structure
                    '*' => [
                        'id',
                        'content',
                        'created_at',
                        'updated_at',
                        'user' => [
                            'id', 'name'
                        ] 
                    ]
                ],
                'links',
                'meta'])
            ->assertJsonCount(10, 'data');
    }
}
