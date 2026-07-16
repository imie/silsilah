<?php

namespace Tests\Feature;

use App\Jobs\Images\OptimizeImages;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Storage;
use Tests\TestCase;

class UsersProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_search_users_profile()
    {
        $user = $this->loginAsUser();

        $jono = User::factory()->create(['name' => 'Jono']);
        $jeni = User::factory()->create(['name' => 'Jeni']);
        $johan = User::factory()->create(['name' => 'Johan']);

        $this->visitRoute('users.search', ['q' => 'jo']);
        $this->seeRouteIs('users.search', ['q' => 'jo']);

        $this->seeText('Jono');
        $this->seeText('Johan');
        $this->dontSeeText('Jeni');
    }

    public function test_user_can_view_other_users_profile()
    {
        $user = $this->loginAsUser();
        $this->visit(route('users.show', $user->id));
        $this->see($user->name);
    }

    public function test_user_will_see_edit_profile_if_an_invalid_tab_selected()
    {
        $user = $this->loginAsUser();
        $this->visit(route('users.edit', [$user->id, 'tab' => 'invalid_tab']));
        $this->seePageIs(route('users.edit', [$user->id, 'tab' => 'invalid_tab']));
        $this->seeElement('input', ['name' => 'nickname']);
        $this->seeElement('input', ['name' => 'name']);
    }

    public function test_user_can_edit_profile()
    {
        $user = $this->loginAsUser();
        $this->visit(route('users.edit', $user->id));
        $this->seePageIs(route('users.edit', $user->id));

        $this->submitForm(trans('app.update'), [
            'nickname' => 'Nama Panggilan',
            'name' => 'Nama User',
            'gender_id' => 1,
            'dob' => '1959-06-09',
            'yob' => '',
            'birth_order' => 3,
        ]);

        $this->seeInDatabase('users', [
            'nickname' => 'Nama Panggilan',
            'name' => 'Nama User',
            'gender_id' => 1,
            'dob' => '1959-06-09',
            'yob' => '1959',
            'birth_order' => 3,
        ]);
    }

    public function test_user_can_update_yob_only()
    {
        $user = $this->loginAsUser();
        $this->visit(route('users.edit', $user->id));
        $this->seePageIs(route('users.edit', $user->id));

        $this->submitForm(trans('app.update'), [
            'dob' => '',
            'yob' => '2003',
        ]);

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'dob' => null,
            'yob' => '2003',
        ]);
    }

    public function test_user_can_edit_contact_address()
    {
        $user = $this->loginAsUser();
        $this->visit(route('users.edit', [$user->id, 'tab' => 'contact_address']));
        $this->seePageIs(route('users.edit', [$user->id, 'tab' => 'contact_address']));

        $this->submitForm(trans('app.update'), [
            'address' => 'Jln. Angkasa, No. 70',
            'city' => 'Nama Kota',
            'phone' => '081234567890',
        ]);

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'address' => 'Jln. Angkasa, No. 70',
            'city' => 'Nama Kota',
            'phone' => '081234567890',
        ]);
    }

    public function test_user_can_edit_login_account()
    {
        $user = $this->loginAsUser();
        $this->visit(route('users.edit', [$user->id, 'tab' => 'login_account']));
        $this->seePageIs(route('users.edit', [$user->id, 'tab' => 'login_account']));

        $this->submitForm(trans('app.update'), [
            'email' => '',
            'password' => '',
        ]);

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'email' => null,
            'password' => null,
        ]);
    }

    public function test_user_can_edit_death()
    {
        $user = $this->loginAsUser();
        $this->visit(route('users.edit', [$user->id, 'tab' => 'death']));
        $this->seePageIs(route('users.edit', [$user->id, 'tab' => 'death']));

        $this->submitForm(trans('app.update'), [
            'dod' => '2003-10-17',
            'yod' => '',
        ]);

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'dod' => '2003-10-17',
            'yod' => '2003',
        ]);
    }

    public function test_user_can_update_yod_only()
    {
        $user = $this->loginAsUser();
        $this->visit(route('users.edit', [$user->id, 'tab' => 'death']));
        $this->seePageIs(route('users.edit', [$user->id, 'tab' => 'death']));

        $this->submitForm(trans('app.update'), [
            'dod' => '',
            'yod' => '2003',
        ]);

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'dod' => null,
            'yod' => '2003',
        ]);
    }

    public function test_user_can_update_died_person_cemetary_location()
    {
        $user = $this->loginAsUser();
        $this->visit(route('users.edit', [$user->id, 'tab' => 'death']));
        $this->seePageIs(route('users.edit', [$user->id, 'tab' => 'death']));

        $this->submitForm(trans('app.update'), [
            'dod' => '',
            'yod' => '2003',
            'cemetery_location_name' => 'Some name',
            'cemetery_location_address' => 'Some address',
            'cemetery_location_latitude' => '-3.333333',
            'cemetery_location_longitude' => '114.583333',
        ]);

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'dod' => null,
            'yod' => '2003',
        ]);

        $this->seeInDatabase('user_metadata', [
            'user_id' => $user->id,
            'key' => 'cemetery_location_name',
            'value' => 'Some name',
        ]);

        $this->seeInDatabase('user_metadata', [
            'user_id' => $user->id,
            'key' => 'cemetery_location_address',
            'value' => 'Some address',
        ]);

        $this->seeInDatabase('user_metadata', [
            'user_id' => $user->id,
            'key' => 'cemetery_location_latitude',
            'value' => '-3.333333',
        ]);

        $this->seeInDatabase('user_metadata', [
            'user_id' => $user->id,
            'key' => 'cemetery_location_longitude',
            'value' => '114.583333',
        ]);
    }

    public function test_user_metadata_can_be_prefilled_on_the_edit_form()
    {
        $user = $this->loginAsUser();
        DB::table('user_metadata')->insert([
            'id' => Uuid::uuid4()->toString(),
            'user_id' => $user->id,
            'key' => 'cemetery_location_name',
            'value' => 'Some place name',
        ]);

        $this->visit(route('users.edit', [$user->id, 'tab' => 'death']));
        $this->seePageIs(route('users.edit', [$user->id, 'tab' => 'death']));
        $this->seeElement('input', [
            'name' => 'cemetery_location_name',
            'value' => 'Some place name',
        ]);
    }

    public function test_manager_can_add_login_account_on_a_user()
    {
        $manager = $this->loginAsUser();
        $user = User::factory()->create(['manager_id' => $manager->id]);
        $this->visit(route('users.edit', [$user->id, 'tab' => 'login_account']));
        $this->seePageIs(route('users.edit', [$user->id, 'tab' => 'login_account']));

        $this->submitForm(trans('app.update'), [
            'email' => 'user@mail.com',
            'password' => 'Secr3t',
        ]);

        $user = $user->fresh();
        $this->assertEquals('user@mail.com', $user->email);
        $this->assertTrue(app('hash')->check('Secr3t', $user->password));
    }

    public function test_manager_can_add_user_email_without_a_password()
    {
        $manager = $this->loginAsUser();
        $user = User::factory()->create(['manager_id' => $manager->id]);
        $this->visit(route('users.edit', [$user->id, 'tab' => 'login_account']));
        $this->seePageIs(route('users.edit', [$user->id, 'tab' => 'login_account']));

        $this->submitForm(trans('app.update'), [
            'email' => 'user@mail.com',
            'password' => '',
        ]);

        $user = $user->fresh();
        $this->assertEquals('user@mail.com', $user->email);
        $this->assertNull($user->password);
    }

    public function test_empty_password_does_not_replace_existing()
    {
        $manager = $this->loginAsUser();
        $user = User::factory()->create([
            'manager_id' => $manager->id,
            'password' => 'some random string password',
        ]);
        $this->visit(route('users.edit', [$user->id, 'tab' => 'login_account']));
        $this->seePageIs(route('users.edit', [$user->id, 'tab' => 'login_account']));

        $this->submitForm(trans('app.update'), [
            'email' => 'user@mail.com',
            'password' => '',
        ]);

        $this->seeInDatabase('users', [
            'id' => $user->id,
            'manager_id' => $manager->id,
            'password' => 'some random string password',
        ]);
    }

    public function test_user_can_upload_their_own_photo()
    {
        Bus::fake();
        Storage::fake(config('filesystems.default'));

        $user = $this->loginAsUser();
        $this->visit(route('users.edit', $user->id));
        $this->assertNull($user->photo_path);

        $this->attach(public_path('images/icon_user_1.png'), 'photo');
        $this->press(trans('user.update_photo'));

        $this->seePageIs(route('users.edit', $user));

        $user = $user->fresh();

        $this->assertNotNull($user->photo_path);
        Bus::assertDispatched(OptimizeImages::class);
        Storage::assertExists($user->photo_path);
    }
}
