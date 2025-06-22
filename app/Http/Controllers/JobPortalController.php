<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobPortalController extends Controller
{
    public function create()
    {
        return view('job-portals.create');
    }

    public function index()
    {
        $jobPosts = DB::select("SELECT * FROM job_posts");
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

        $validated['user_id'] = auth()->id();
        $now = now();

        DB::statement("
            INSERT INTO job_posts (title, salary, type, location, company, description, user_id, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ", [
            $validated['title'],
            $validated['salary'],
            $validated['type'],
            $validated['location'],
            $validated['company'],
            $validated['description'],
            $validated['user_id'],
            $now,
            $now
        ]);

        return redirect()->route('job-portals.index')->with('success', 'Job post created successfully!');
    }

    public function show($id)
    {
        $jobPost = DB::selectOne("SELECT * FROM job_posts WHERE id = ?", [$id]);
        return view('job-portals.show', compact('jobPost'));
    }

    public function edit($id)
    {
        $jobPost = DB::selectOne("SELECT * FROM job_posts WHERE id = ?", [$id]);
        return view('job-portals.edit', compact('jobPost'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $now = now();

        DB::statement("
            UPDATE job_posts
            SET title = ?, salary = ?, type = ?, location = ?, company = ?, description = ?, updated_at = ?
            WHERE id = ?
        ", [
            $validated['title'],
            $validated['salary'],
            $validated['type'],
            $validated['location'],
            $validated['company'],
            $validated['description'],
            $now,
            $id
        ]);

        return redirect()->route('job-portals.show', $id)->with('success', 'Job post updated successfully!');
    }

    public function destroy($id)
    {
        $jobPost = DB::selectOne("SELECT * FROM job_posts WHERE id = ?", [$id]);
        DB::statement("DELETE FROM job_posts WHERE id = ?", [$id]);
        return redirect()->route('job-portals.index')->with('success', 'Job post deleted successfully!');
    }
}
