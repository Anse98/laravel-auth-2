<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();

        return view('admin.project_types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {

        $data = $request->validated();

        $data['slug'] = Str::slug($data['name'], '-');

        $new_type = Type::create($data);

        return redirect()->route('admin.project_types.show', $new_type->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $project_type)
    {
        return view('admin.project_types.show', compact('project_type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $project_type)
    {
        return view('admin.project_types.edit', compact('project_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $project_type)
    {
        $project_type->update($request->validated());
        return redirect()->route('admin.project_types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $project_type)
    {
        $project_type->delete();

        return redirect()->route('admin.project_types.index');
    }
}
