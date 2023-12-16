<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {
        $project = auth()->user()->projects()->create(request()->validate([
            'title' => 'required',
            'description' => 'required',
            'notes' => 'min:3',
        ]));

        return redirect($project->path());
    }

    public function update(Project $project)
    {
        $this->authorize('update', $project);

        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }

        $project->update([
            'notes' => request('notes')
        ]);

        return redirect($project->path());
    }

    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }
}
