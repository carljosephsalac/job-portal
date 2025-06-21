<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPortalController extends Controller
{
    public function create()
    {
        return view('job-portals.create');
    }

    public function index()
    {
        $jobPosts = JobPost::all();
        return view('job-portals.index', compact('jobPosts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $validated ['user_id'] = auth()->id();

        JobPost::create($validated);

        return redirect()->route('job-portals.index')->with('success', 'Job post created successfully!');
    }

    public function show(JobPost $jobPost)
    {
        return view('job-portals.show', compact('jobPost'));
    }

    public function edit(JobPost $jobPost)
    {
        return view('job-portals.edit', compact('jobPost'));
    }

    public function update(Request $request, JobPost $jobPost)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $jobPost->update($validated);

        return redirect()->route('job-portals.show', $jobPost)->with('success', 'Job post updated successfully!');
    }

    public function destroy(JobPost $jobPost)
    {
        $jobPost->delete();
        return redirect()->route('job-portals.index')->with('success', 'Job post deleted successfully!');
    }
}
