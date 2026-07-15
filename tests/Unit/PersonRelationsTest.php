<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonRelationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_user_model_with_factory()
    {
        $person = User::factory()->create();

        $this->seeInDatabase('users', [
            'nickname' => $person->nickname,
            'gender_id' => $person->gender_id,
        ]);
    }

    public function test_person_can_have_a_father()
    {
        $person = User::factory()->create();
        $father = User::factory()->male()->create();
        $person->setFather($father);

        $this->seeInDatabase('users', [
            'id' => $person->id,
            'father_id' => $father->id,
        ]);

        $this->assertEquals($father->name, $person->father->name);
    }

    public function test_person_can_have_a_mother()
    {
        $person = User::factory()->create();
        $mother = User::factory()->female()->create();
        $person->setMother($mother);

        $this->seeInDatabase('users', [
            'id' => $person->id,
            'mother_id' => $mother->id,
        ]);

        $this->assertEquals($mother->name, $person->mother->name);
    }

    public function test_person_can_many_childs()
    {
        $mother = User::factory()->female()->create();
        $person = User::factory()->create();
        $person->setMother($mother);
        $person = User::factory()->create();
        $person->setMother($mother);

        $this->assertCount(2, $mother->childs);
    }
}
