<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
   
    public function index(Request $request)
    {
    
        $query = Company::with('jobs')->latest();
        if ($request->boolean('onlySaved') && Auth::check()) {
        $user = Auth::user();

        $query->whereHas('interestedUsers', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        });
    }

    $companies = $query->paginate(3)->withQueryString();

    return Inertia::render('Companies/Index', [
        'companies' => $companies,
        'onlySaved' => $request->boolean('onlySaved'),
    ]);
}


    public function show(Company $company)
    {
        $comments = $company->comments()
        ->withTrashed() 
        ->with('user')
        ->latest()
        ->get()
        ->filter(function ($comment) {
        return !$comment->deleted_at || $comment->user_id === auth()->id();
        });

        $company->load(['jobs', 'interestedUsers']);
    
        $user = auth()->user();

        return Inertia::render('Companies/Show', [
        'company' => $company,
        'jobs' => $company->jobs,
        'comments' => $comments,
        'authUserId' => auth()->id(),
        'isInterested' => $user ? $company->interestedUsers->contains($user->id) : false,
        'interestedCount' => $company->interestedUsers->count(),
    ]);
}

    public function toggleInterest(Company $company)
    {
    $user = Auth::user();

    if ($company->interestedUsers()->where('user_id', $user->id)->exists()) {
        $company->interestedUsers()->detach($user->id);
    } else {
        $company->interestedUsers()->attach($user->id);
    }

    return Redirect::back();
    }
   
    public function create()
    {
        return Inertia::render('Companies/Create');
    }

    public function interestedCompanies()
    {
    $user = Auth::user();

    $companies = $user->interestedCompanies()
        ->with('jobs')
        ->latest()
        ->paginate(5);

    return Inertia::render('Companies/Interested', [
        'companies' => $companies,
    ]);
    }   


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'description' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'logo' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('companies', 'public');
            $validated['logo'] = '/storage/' . $path;
        }

        Company::create($validated);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        return Inertia::render('Companies/Edit', [
            'company' => $company,
        ]);
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'address' => 'nullable|string',
        'city' => 'nullable|string',
        'country' => 'nullable|string',
        'phone' => 'nullable|string',
        'logo' => 'nullable|image|max:2048',
     ]);


    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('companies', 'public');
        $validated['logo'] = '/storage/' . $path;
    }

    $company->update($validated);

    return redirect()->route('companies.show', $company);
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
