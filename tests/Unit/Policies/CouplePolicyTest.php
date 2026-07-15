<?php

namespace Tests\Unit\Policies;

use App\Couple;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class CouplePolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager_can_edit_couples()
    {
        $otherCoupleManagerId = Str::random();
        $manager = User::factory()->create();
        $couple = Couple::factory()->create(['manager_id' => $manager->id]);
        $otherCouple = Couple::factory()->create(['manager_id' => $otherCoupleManagerId]);

        $this->assertTrue($manager->can('edit', $couple));
        $this->assertFalse($manager->can('edit', $otherCouple));
    }

    public function test_admins_can_edit_any_couple_data()
    {
        $adminEmail = 'admin@example.net';
        $otherCoupleManagerId = Str::random();
        config(['app.system_admin_emails' => $adminEmail]);

        $manager = User::factory()->create();
        $admin = User::factory()->create(['email' => $adminEmail]);
        $couple = Couple::factory()->create(['manager_id' => $manager->id]);
        $otherCouple = Couple::factory()->create(['manager_id' => $otherCoupleManagerId]);

        $this->assertTrue($admin->can('edit', $couple));
        $this->assertTrue($admin->can('edit', $otherCouple));

        $this->assertTrue($manager->can('edit', $couple));
        $this->assertFalse($manager->can('edit', $otherCouple));
    }

    public function test_husband_can_edit_their_own_couple_data()
    {
        $couple = Couple::factory()->create();
        $anotherCouple = Couple::factory()->create();

        $this->assertTrue($couple->husband->can('edit', $couple));
        $this->assertFalse($anotherCouple->husband->can('edit', $couple));
    }

    public function test_wife_can_edit_their_own_couple_data()
    {
        $couple = Couple::factory()->create();
        $anotherCouple = Couple::factory()->create();

        $this->assertTrue($couple->wife->can('edit', $couple));
        $this->assertFalse($anotherCouple->wife->can('edit', $couple));
    }
}
