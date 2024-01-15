<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate([
            'title' => 'required|max:255|string|unique:projects',
            'thumb' => [
                'nullable',
                File::image()
                    ->min('1kb')
                    ->max('35mb')
            ],
            'description' => 'nullable|min:10|string',
            'type_id' => 'nullable|exists:types,id',
            'technology_id' => 'exists:technologies,id'
        ]);

        $data['slug'] = Str::slug($data['title'], '-');

        if ($request->hasFile('thumb')) {

            $file_path = Storage::put('images', $request->thumb);

            $data['thumb'] = $file_path;
        }

        $new_project = Project::create($data);

        if ($request->has('technologies')) {

            $new_project->technologies()->attach($data['technologies']);
        }


        return redirect()->route('admin.projects.show', $new_project->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();

        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => ['required', 'max:255', 'string', Rule::unique('projects')->ignore($project->id)],
            'thumb' => [
                'nullable',
                File::image()
                    ->min('1kb')
                    ->max('35mb')
            ],
            'description' => 'nullable|min:10|string',
            'type_id' => 'nullable|exists:types,id',
            'technology_id' => 'exists:technologies,id'

        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($data['title'], '-');

        if ($request->hasFile('thumb')) {

            if ($project->thumb) {
                Storage::delete($project->thumb);
            }

            $file_path = Storage::put('images', $request->thumb);

            $data['thumb'] = $file_path;
        } else {

            if ($project->thumb) {
                Storage::delete($project->thumb);
            }

            $project->thumb = null;
        }


        $project->update($data);

        if ($request->has('technologies')) {

            $project->technologies()->sync($data['technologies']);
        } else {

            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        $project->technologies()->sync([]);

        if ($project->thumb) {
            Storage::delete($project->thumb);
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
