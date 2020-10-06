<?php

namespace Tests\Models;

use App\Models\SubTask;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Database\Factories\SubTaskFactory;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return void
     */
    public function testShouldCreateUser()
    {
        $task = Task::factory()->create();
        $this->assertInstanceOf(Task::class, $task);
    }

    /**
     * @return void
     */
    public function testShouldFetchUsersWhichHaveAccessToTheTask()
    {
        $users = User::factory()->count(3)->create();
        $task = Task::factory()->create();
        $task->users()->saveMany($users->take(2));
        $this->assertCount(2, $task->users);
        $this->assertEquals($users[0]->id, $task->users[0]->id);
        $this->assertEquals($users[1]->id, $task->users[1]->id);
    }

    /**
     * @return void
     */
    public function testShouldFetchTeamsWhichHaveAccessToTheTask()
    {
        $teams = Team::factory()->count(3)->create();
        $task = Task::factory()->create();
        $task->teams()->saveMany($teams->take(2));
        $this->assertCount(2, $task->teams);
        $this->assertEquals($teams[0]->id, $task->teams[0]->id);
        $this->assertEquals($teams[1]->id, $task->teams[1]->id);
    }

    /**
     * @return void
     */
    public function testShouldFetchSubTasks()
    {
        $task = Task::factory()->create();
        $subtasks = SubTask::factory()->count(3)->create();
        $task->subtasks()->saveMany($subtasks->take(2));
        $this->assertCount(2, $task->subtasks);
        $this->assertEquals($subtasks[0]->id, $task->subtasks[0]->id);
        $this->assertEquals($subtasks[1]->id, $task->subtasks[1]->id);
    }
}
