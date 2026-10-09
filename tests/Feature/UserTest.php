<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_list_users(): void
    {
        $user = User::factory()->create();
        User::factory()->count(5)->create();

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/users');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    '*' => ['id', 'name', 'email', 'role'],
                ],
                'meta',
                'links',
            ]);
    }

    public function test_authenticated_user_can_create_user(): void
    {
        $admin = User::factory()->create(['role' => UserRole::ADMIN]);

        $response = $this->actingAs($admin, 'sanctum')
            ->postJson('/api/v1/users', [
                'name'     => 'New User',
                'email'    => 'newuser@example.com',
                'password' => 'password123',
                'role'     => 'user',
            ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'data'    => [
                    'email' => 'newuser@example.com',
                ],
            ]);

        $this->assertDatabaseHas('users', ['email' => 'newuser@example.com']);
    }

    public function test_authenticated_user_can_show_user_details(): void
    {
        $admin = User::factory()->create();
        $targetUser = User::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')
            ->getJson('/api/v1/users/' . $targetUser->id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data'    => [
                    'id'    => $targetUser->id,
                    'email' => $targetUser->email,
                ],
            ]);
    }

    public function test_authenticated_user_can_update_user(): void
    {
        $admin = User::factory()->create();
        $targetUser = User::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')
            ->putJson('/api/v1/users/' . $targetUser->id, [
                'name' => 'Updated Name',
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data'    => [
                    'name' => 'Updated Name',
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'id'   => $targetUser->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_authenticated_user_can_delete_user(): void
    {
        $admin = User::factory()->create();
        $targetUser = User::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')
            ->deleteJson('/api/v1/users/' . $targetUser->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('users', ['id' => $targetUser->id]);
    }
}
