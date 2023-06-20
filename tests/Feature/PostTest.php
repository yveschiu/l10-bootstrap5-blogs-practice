<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_no_blog_posts_when_nothing_in_database(): void
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No blog posts yet!');
    }

    public function test_see_one_blog_post_when_there_is_only_one(): void
    {
        // Arrange
        $post = $this->createDummyPost();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('New title');

        $this->assertDatabaseHas('posts', $post->toArray());
    }

    public function test_store_valid(): void
    {
        // Arrange
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters',
        ];

        // Act
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        // Assert
        $this->assertEquals(session('status'), 'Post was created!');
    }

    public function test_store_fail(): void
    {
        // Arrange
        $params = [
            'title' => 'x',
            'content' => 'x',
        ];

        // Act
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        // Assert
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title field must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content field must be at least 10 characters.');
    }

    public function test_update_valid(): void
    {
        // Arrange
        $post = $this->createDummyPost();

        // Act
        $this->put("/posts/{$post->id}", [
            'title' => 'A new named title',
            'content' => 'Content was changed',
        ])
            ->assertStatus(302)
            ->assertSessionHas('status');

        // Assert
        $this->assertEquals(session('status'), 'Post was updated!');

        $this->assertDatabaseMissing('posts', $post->toArray());
        $this->assertDatabaseHas('posts', [
            'title' => 'A new named title',
        ]);
    }

    public function test_delete(): void
    {
        // Arrange
        $post = $this->createDummyPost();

        // Act
        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        // Assert
        $this->assertEquals(session('status'), 'Post was deleted!');
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    private function createDummyPost(): Post
    {
        return Post::create([
            'title' => 'New title',
            'content' => 'Content of the blog post',
        ]);
    }
}
