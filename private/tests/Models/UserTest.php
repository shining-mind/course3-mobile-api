<?php

namespace Tests\Models;

use App\Models\Team;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return void
     */
    public function testShouldCreateUser()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * @return void
     */
    public function testShouldFetchTeamsWhereUserIsAMember()
    {
        $owner = User::factory()->create();
        $user = User::factory()->create();
        $teams = Team::factory()->count(3)->create(['user_id' => $owner->id]);
        $user->teams()->saveMany($teams->take(2));
        $this->assertCount(2, $user->teams);
        $this->assertEquals($teams[0]->id, $user->teams[0]->id);
        $this->assertEquals($teams[1]->id, $user->teams[1]->id);
    }
}
