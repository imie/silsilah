<?php

namespace Tests\Feature;

use App\Couple;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager_can_delete_a_user()
    {
        $manager = $this->loginAsUser();
        $user = User::factory()->create(['manager_id' => $manager->id]);

        $this->visit(route('users.edit', $user));
        $this->seeElement('a', ['id' => 'del-user-'.$user->id]);

        $this->click('del-user-'.$user->id);
        $this->seePageIs(route('users.edit', [$user, 'action' => 'delete']));
        $this->see(__('user.delete_confirm_button'));

        $this->press(__('user.delete_confirm_button'));

        $this->dontSeeInDatabase('users', [
            'id' => $user->id,
        ]);
    }

    public function test_manager_can_delete_a_user_the_replace_childs_father_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = User::factory()->male()->create([
            'manager_id' => $manager->id,
        ]);
        $oldUserChild = User::factory()->create(['father_id' => $oldUser->id]);
        $replacementUser = User::factory()->male()->create([
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'father_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('users', [
            'id'        => $oldUserChild->id,
            'father_id' => $replacementUser->id,
        ]);
    }

    public function test_manager_can_delete_a_user_the_replace_childs_mother_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = User::factory()->female()->create([
            'manager_id' => $manager->id,
        ]);
        $oldUserChild = User::factory()->create(['mother_id' => $oldUser->id]);
        $replacementUser = User::factory()->female()->create([
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'mother_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('users', [
            'id'        => $oldUserChild->id,
            'mother_id' => $replacementUser->id,
        ]);
    }

    public function test_manager_can_delete_a_user_the_replace_users_manager_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = User::factory()->male()->create([
            'manager_id' => $manager->id,
        ]);
        $oldUserManagedUser = User::factory()->create(['manager_id' => $oldUser->id]);
        $replacementUser = User::factory()->male()->create([
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'manager_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('users', [
            'id'         => $oldUserManagedUser->id,
            'manager_id' => $replacementUser->id,
        ]);
    }

    public function test_manager_can_delete_a_user_the_replace_couples_husband_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = User::factory()->male()->create([
            'manager_id' => $manager->id,
        ]);
        $oldUserCouple = Couple::factory()->create([
            'husband_id' => $oldUser->id,
        ]);
        $replacementUser = User::factory()->male()->create([
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('couples', [
            'husband_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('couples', [
            'id'         => $oldUserCouple->id,
            'husband_id' => $replacementUser->id,
        ]);
    }

    public function test_manager_can_delete_a_user_the_replace_couples_wife_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = User::factory()->female()->create([
            'manager_id' => $manager->id,
        ]);
        $oldUserCouple = Couple::factory()->create([
            'wife_id' => $oldUser->id,
        ]);
        $replacementUser = User::factory()->female()->create([
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('couples', [
            'wife_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('couples', [
            'id'      => $oldUserCouple->id,
            'wife_id' => $replacementUser->id,
        ]);
    }

    public function test_manager_can_delete_a_user_the_replace_couples_manager_id()
    {
        $manager = $this->loginAsUser();
        $oldUser = User::factory()->male()->create([
            'manager_id' => $manager->id,
        ]);
        $oldCoupleManagedCouple = Couple::factory()->create([
            'manager_id' => $oldUser->id,
        ]);
        $replacementUser = User::factory()->male()->create([
            'manager_id' => $manager->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', [
            'id' => $oldUser->id,
        ]);

        $this->dontSeeInDatabase('couples', [
            'manager_id' => $oldUser->id,
        ]);

        $this->seeInDatabase('couples', [
            'id'         => $oldCoupleManagedCouple->id,
            'manager_id' => $replacementUser->id,
        ]);
    }

    public function test_user_replacement_options_only_available_on_same_gender()
    {
        $manager = $this->loginAsUser();
        $maleUser = User::factory()->male()->create([
            'manager_id' => $manager->id,
        ]);
        $maleUserChild = User::factory()->create(['father_id' => $maleUser->id]);

        $replacementMaleUser = User::factory()->male()->create();
        $femaleUser = User::factory()->female()->create();

        $this->visit(route('users.edit', [$maleUser, 'action' => 'delete']));

        $this->see(__('user.replace_delete_text'));
        $this->seeElement('option', ['value' => $replacementMaleUser->id]);
        $this->dontSeeElement('option', ['value' => $femaleUser->id]);
    }

    public function test_bugfix_handle_duplicated_couple_on_user_deletion()
    {
        $manager = $this->loginAsUser();
        $singleWife = User::factory()->female()->create(['manager_id' => $manager->id]);
        $oldUser = User::factory()->male()->create(['manager_id' => $manager->id]);
        $replacementUser = User::factory()->male()->create(['manager_id' => $manager->id]);
        $oldUserCouple = Couple::factory()->create([
            'husband_id' => $oldUser->id,
            'wife_id'    => $singleWife->id,
        ]);
        $duplicatedCouple = Couple::factory()->create([
            'husband_id' => $replacementUser->id,
            'wife_id'    => $singleWife->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', ['id' => $oldUser->id]);

        $this->dontSeeInDatabase('couples', ['husband_id' => $oldUser->id]);

        $this->seeInDatabase('couples', [
            'id'         => $oldUserCouple->id,
            'husband_id' => $replacementUser->id,
            'wife_id'    => $singleWife->id,
        ]);
    }

    public function test_bugfix_handle_duplicated_couple_on_user_deletion_with_different_marriages()
    {
        $manager = $this->loginAsUser();
        $oldUserWife = User::factory()->female()->create(['manager_id' => $manager->id]);
        $replacementUserWife = User::factory()->female()->create(['manager_id' => $manager->id]);
        $oldUser = User::factory()->male()->create(['manager_id' => $manager->id]);
        $replacementUser = User::factory()->male()->create(['manager_id' => $manager->id]);
        $oldUserCouple = Couple::factory()->create([
            'husband_id' => $oldUser->id,
            'wife_id'    => $oldUserWife->id,
        ]);
        $newUserCouple = Couple::factory()->create([
            'husband_id' => $replacementUser->id,
            'wife_id'    => $replacementUserWife->id,
        ]);

        $this->visit(route('users.edit', [$oldUser, 'action' => 'delete']));
        $this->see(__('user.replace_delete_text'));

        $this->submitForm(__('user.replace_delete_button'), [
            'replacement_user_id' => $replacementUser->id,
        ]);

        $this->dontSeeInDatabase('users', ['id' => $oldUser->id]);

        $this->dontSeeInDatabase('couples', ['husband_id' => $oldUser->id]);

        $this->seeInDatabase('couples', [
            'id'         => $oldUserCouple->id,
            'husband_id' => $replacementUser->id,
            'wife_id'    => $oldUserWife->id,
        ]);

        $this->seeInDatabase('couples', [
            'id'         => $newUserCouple->id,
            'husband_id' => $replacementUser->id,
            'wife_id'    => $replacementUserWife->id,
        ]);
    }
}
