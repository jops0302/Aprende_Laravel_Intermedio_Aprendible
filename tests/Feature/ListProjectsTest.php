<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListProjectsTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_see_all_projects()
    {

        // $user = factory('App\User', 3)->create();
        // $user = factory('App\User')->times(333)->create(['name' => 'jorge']);

        // en el create le podemos pasar los valores que queremos que esten por defecto por ejemplo ['name' => 'jorge']
        // con times le decimos cuantos registros haga, y si no queremos escribir times podemos pasarle el numero de registros como segundo prametro en el factory de las dos formas funciona

        

        $this->withExceptionHandling();

        $project = factory(Project::class)->create();
        $project2 = factory(Project::class)->create();



        $response = $this->get(route('projects.index'));

        $response->assertStatus(200);

        $response->assertViewIs('projects.index');

        $response->assertViewHas('projects');

        $response->assertSee($project->title);
        $response->assertSee($project2->title);
    }

    public function test_can_see_individual_projects()
    {
        $project = factory(Project::class)->create();
        $project2 = factory(Project::class)->create();

        $response = $this->get(route('projects.show', $project));

        $response->assertSee($project->title);
        $response->assertDontSee($project2->title);
    }
}
