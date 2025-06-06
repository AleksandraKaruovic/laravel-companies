<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Company;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs=Job::with('company')->latest()->simplePaginate(3);
        return  Inertia::render('Jobs', [
        'jobs' => $jobs,
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     $companies = Company::select('id', 'name')->get();
    return Inertia::render('Jobs/CreateJob', [
        'companies' => $companies,
    ]);
    }


    /**
     * Display the specified resource.
     */
   public function show(Job $job)
   
    {
        $job->load('company');
        return Inertia::render('Jobs/Show', [
        'job' => $job,
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|min:3',
        'salary' => 'required',
        'company_id' => 'required|exists:companies,id',
    ]);

    Job::create([
        'title' => $validated['title'],
        'salary' => $validated['salary'],
        'company_id' => $validated['company_id'], 
    ]);

    return redirect('/jobs');
}



 public function edit(Job $job)
{
    $companies = Company::select('id', 'name')->get();

    return Inertia::render('Jobs/EditJob', [
        'job' => $job,
        'companies' => $companies,
    ]);
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Job $job)
{
    $validated = $request->validate([
        'title' => 'required|min:3',
        'salary' => 'required',
        'company_id' => 'required|exists:companies,id',
    ]);

    $job->update($validated);

    return redirect()->route('jobs.show', $job->id)->with('success', 'Job updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
    $job->delete();

    return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}
