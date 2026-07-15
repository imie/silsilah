<?php

namespace Tests\Unit\Policies;

use App\Couple;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager_can_edit_users_profile()
    {
        $otherUserManagerId = Str::random();
        $manager = User::factory()->create();
        $user = User::factory()->create(['manager_id' => $manager->id]);
        $otherUser = User::factory()->create(['manager_id' => $otherUserManagerId]);

        $this->assertTrue($manager->can('edit', $user));
        $this->assertFalse($manager->can('edit', $otherUser));
    }

    public function test_admins_can_edit_any_user_profile()
    {
        $adminEmail = 'admin@example.net';
        $otherUserManagerId = Str::random();
        config(['app.system_admin_emails' => $adminEmail]);

        $manager = User::factory()->create();
        $admin = User::factory()->create(['email' => $adminEmail]);
        $user = User::factory()->create(['manager_id' => $manager->id]);
        $otherUser = User::factory()->create(['manager_id' => $otherUserManagerId]);

        $this->assertTrue($admin->can('edit', $user));
        $this->assertTrue($admin->can('edit', $otherUser));

        $this->assertTrue($manager->can('edit', $user));
        $this->assertFalse($manager->can('edit', $otherUser));
    }

    public function test_user_can_edit_their_own_profile()
    {
        $user = User::factory()->create();

        $this->assertTrue($user->can('edit', $user));
    }

    public function test_manager_can_delete_a_user()
    {
        $otherUserManagerId = Str::random();
        $manager = User::factory()->create();
        $user = User::factory()->create(['manager_id' => $manager->id]);
        $otherUser = User::factory()->create(['manager_id' => $otherUserManagerId]);

        $this->assertTrue($manager->can('delete', $user));
        $this->assertFalse($manager->can('delete', $otherUser));
    }

    public function test_admins_can_delete_any_user()
    {
        $adminEmail = 'admin@example.net';
        $otherUserManagerId = Str::random();
        config(['app.system_admin_emails' => $adminEmail]);

        $manager = User::factory()->create();
        $admin = User::factory()->create(['email' => $adminEmail]);
        $user = User::factory()->create(['manager_id' => $manager->id]);
        $otherUser = User::factory()->create(['manager_id' => $otherUserManagerId]);

        $this->assertTrue($admin->can('delete', $user));
        $this->assertTrue($admin->can('delete', $otherUser));

        $this->assertTrue($manager->can('delete', $user));
        $this->assertFalse($manager->can('delete', $otherUser));
    }

    public function test_user_cannot_delete_their_own_data()
    {
        $user = User::factory()->create();

        $this->assertFalse($user->can('delete', $user));
    }

    public function test_father_can_edit_their_childs_profile()
    {
        $father = User::factory()->male()->create();
        $child = User::factory()->create(['father_id' => $father->id]);
        $otherUser = User::factory()->create();

        $this->assertTrue($father->can('edit', $child));
        $this->assertFalse($otherUser->can('edit', $child));
    }

    public function test_mother_can_edit_their_childs_profile()
    {
        $mother = User::factory()->female()->create();
        $child = User::factory()->create(['mother_id' => $mother->id]);
        $otherUser = User::factory()->create();

        $this->assertTrue($mother->can('edit', $child));
        $this->assertFalse($otherUser->can('edit', $child));
    }

    public function test_child_can_edit_their_fathers_profile()
    {
        $father = User::factory()->male()->create();
        $child = User::factory()->create(['father_id' => $father->id]);
        $otherUser = User::factory()->create();

        $this->assertTrue($child->can('edit', $father));
        $this->assertFalse($otherUser->can('edit', $father));
    }

    public function test_child_can_edit_their_mothers_profile()
    {
        $mother = User::factory()->female()->create();
        $child = User::factory()->create(['mother_id' => $mother->id]);
        $otherUser = User::factory()->create();

        $this->assertTrue($child->can('edit', $mother));
        $this->assertFalse($otherUser->can('edit', $mother));
    }

    public function test_husband_can_edit_their_wifes_profile()
    {
        $couple = Couple::factory()->create();
        $otherUser = User::factory()->create();

        $this->assertTrue($couple->husband->can('edit', $couple->husband->wifes->first()));
        $this->assertFalse($otherUser->can('edit', $couple->husband->wifes->first()));
    }

    public function test_wife_can_edit_their_husbands_profile()
    {
        $couple = Couple::factory()->create();
        $otherUser = User::factory()->create();

        $this->assertTrue($couple->wife->can('edit', $couple->wife->husbands->first()));
        $this->assertFalse($otherUser->can('edit', $couple->wife->husbands->first()));
    }
}
