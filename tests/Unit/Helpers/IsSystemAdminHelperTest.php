<?php

namespace Tests\Unit\Helpers;

use App\User;
use Tests\TestCase;

class IsSystemAdminHelperTest extends TestCase
{
    public function test_user_is_an_admin()
    {
        $adminEmail1 = 'admin1@example.net';
        $adminEmail2 = 'admin2@example.net';
        config(['app.system_admin_emails' => $adminEmail1.';'.$adminEmail2]);

        $admin1 = User::factory()->make(['email' => $adminEmail1]);
        $admin2 = User::factory()->make(['email' => $adminEmail2]);
        $userWithEmail = User::factory()->make(['email' => 'user@example.net']);
        $userWithNoEmail = User::factory()->make(['email' => null]);

        $this->assertTrue(is_system_admin($admin1));
        $this->assertTrue(is_system_admin($admin2));
        $this->assertFalse(is_system_admin($userWithEmail));
        $this->assertFalse(is_system_admin($userWithNoEmail));
    }

    public function test_if_config_is_null()
    {
        $adminEmail1 = 'admin1@example.net';
        $adminEmail2 = 'admin2@example.net';

        $admin1 = User::factory()->make(['email' => $adminEmail1]);
        $admin2 = User::factory()->make(['email' => $adminEmail2]);
        $userWithEmail = User::factory()->make(['email' => 'user@example.net']);
        $userWithNoEmail = User::factory()->make(['email' => null]);

        $this->assertFalse(is_system_admin($admin1));
        $this->assertFalse(is_system_admin($admin2));
        $this->assertFalse(is_system_admin($userWithEmail));
        $this->assertFalse(is_system_admin($userWithNoEmail));
    }
}
