<?php

namespace Tests\Models;

use App\Models\Team;
use App\Models\User;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return void
     */
    public function testShouldCreateUser()
    {
        $team = Team::factory()->create();
        $this->assertInstanceOf(Team::class, $team);
    }

    /**
     * @return void
     */
    public function testShouldFetchTeamsMembers()
    {
        $users = User::factory()->count(3)->create();
        $team1 = Team::factory()->create();
        $team1->members()->saveMany($users->take(2));
        $team2 = Team::factory()->create();
        $team2->members()->save($users[0]);
        $this->assertCount(2, $team1->members);
        $this->assertEquals($users[0]->id, $team1->members[0]->id);
        $this->assertEquals($users[1]->id, $team1->members[1]->id);
        $this->assertCount(2, $users[0]->teams);
        $this->assertCount(1, $users[1]->teams);
        $this->assertEquals($team1->id, $users[0]->teams[0]->id);
        $this->assertEquals($team2->id, $users[0]->teams[1]->id);
        $this->assertEquals($team1->id, $users[1]->teams[0]->id);
    }
}
