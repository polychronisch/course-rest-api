<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_courses()
    {
        Course::factory()->count(5)->create();

        $response = $this->getJson('/api/courses');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_a_course()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/api/courses/{$course->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $course->id]);
    }

    /** @test */
    public function it_can_create_a_course()
    {
        $payload = [
            'title' => 'New Course',
            'description' => 'New description',
            'status' => 'published',
            'is_premium' => true,
            'tags' => ['php', 'laravel'],
        ];

        $response = $this->postJson('/api/courses', $payload);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'New Course']);

        $this->assertDatabaseHas('courses', ['title' => 'New Course']);
    }

    /** @test */
    public function it_can_update_a_course_with_put()
    {
        $course = Course::factory()->create();

        $payload = [
            'title' => 'Updated Course',
            'description' => 'Updated description',
            'status' => 'draft',
            'is_premium' => false,
            'tags' => ['test'],
        ];

        $response = $this->putJson("/api/courses/{$course->id}", $payload);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Updated Course']);

        $this->assertDatabaseHas('courses', ['id' => $course->id, 'title' => 'Updated Course']);
    }

    /** @test */
    public function it_can_partially_update_a_course_with_patch()
    {
        $course = Course::factory()->create([
            'title' => 'Original Title',
            'status' => 'draft',
        ]);

        $payload = [
            'title' => 'Partially Updated Title',
        ];

        $response = $this->patchJson("/api/courses/{$course->id}", $payload);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Partially Updated Title']);

        $this->assertDatabaseHas('courses', ['id' => $course->id, 'title' => 'Partially Updated Title']);
    }

    /** @test */
    public function it_can_soft_delete_a_course()
    {
        $course = Course::factory()->create();

        $response = $this->deleteJson("/api/courses/{$course->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Course deleted successfully.']);

        $this->assertSoftDeleted('courses', ['id' => $course->id]);
    }
}
