<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageUserMarriagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_visit_other_user_marriages_page()
    {
        $user = $this->loginAsUser();

        $this->visit(route('users.marriages', $user->id));
        $this->see($user->name);
    }
}
