<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\project;
use App\Models\Task;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

       $users= User::factory(12)->create();
       $projects= Project::factory(5)->create();
    //    $tasks= Task::factory()->count(30)->create()
    //    ->each(function ($task) use ($users) {
    //     $task->users()->sync(
    //         $users->random(rand(1, 5))->pluck('id')->toArray()
    //     );      
        
    //    });

    //or 
      $projects->each(function($project)use($users){
          Task::factory(30)->create(['project_id' => $project->id])
            ->each(function ($task) use ($users) {
                $task->users()->sync(
                    $users->random(rand(1, 5))->pluck('id')->toArray()
                );
            });
      });

    }
}
