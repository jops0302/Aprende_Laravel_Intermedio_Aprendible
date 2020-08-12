<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\DB;

use App\Category;
use App\Project;
use App\Events\ProjectSaved;
use App\Http\Requests\SaveProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except('index', 'show');
    }

  
    public function index()
    {
        // $portfolio = DB::table('projects')->get();

        return view('projects.index', [
            'newProject' => new Project,
            'projects' => Project::with('category')->latest()->paginate(),
            'deletedProjects' => Project::onlyTrashed()->get()
        ]);
    }


    public function create()
    {

        $this->authorize('create', $project = new Project);
       
            return view('projects.create', [
                'project' => $project,
                'categories' => Category::pluck('name', 'id'),
            ]);

    }

 
    public function store(SaveProjectRequest $request)
    {
        $project = new Project($request->validated());

        $this->authorize('create', $project);


        $project->image = $request->file('image')->store('images');

        $project->save();

       ProjectSaved::dispatch($project);

        //   Project::create(request()->all());

        return redirect()->route('projects.index')->with('status', 'El proyecto fue creado con éxito.');
    }

  
    public function show(Project $project)
    {
        return view('projects.show', [
            'project' => $project
        ]);
    }

 
    public function edit(Project $project)
    {

        $this->authorize('update', $project);


        return view('projects.edit', [
            'project' => $project,
            'categories' => Category::pluck('name', 'id'),
        ]);
    }

  
    public function update(Project $project, SaveProjectRequest $request)
    {
        $this->authorize('update', $project);


        if ($request->hasFile('image')) {

            Storage::delete($project->image);
            $project->fill($request->validated());

            $project->image = $request->file('image')->store('images');

            $project->save();

            ProjectSaved::dispatch($project);

        } else {
            $project->update(array_filter($request->validated()));
        }


        return redirect()->route('projects.show', $project)->with('status', 'El proyecto fue actualizado con éxito.');
    }

 
    public function destroy(Project $project)
    {

        $this->authorize('delete', $project);


        $project->delete();

        return redirect()->route('projects.index')->with('status', 'El proyecto fue eliminado con éxito.');
    }

    public function restore($projectUrl)
    {
       
        // $project = Project::withTranshed()->where('url', $projectUrl)->firstOrFail(); puede ser asi tambien
        $project = Project::withTrashed()->whereUrl($projectUrl)->firstOrFail();
        
        // $this->authorize('restore', $project);
        
        $project->restore();

        return redirect()->route('projects.index')->with('status', 'El proyecto fue restaurado con exito.');

    }

    public function forceDelete($projectUrl)
    {
        
        $project = Project::withTrashed()->whereUrl($projectUrl)->firstOrFail();

        // $this->authorize('forceDelete', $project);
        
        Storage::delete($project->image);
        
        $project->forceDelete();

        return redirect()->route('projects.index')->with('status', 'El proyecto fue eliminado permanentemente.');

    }
}
