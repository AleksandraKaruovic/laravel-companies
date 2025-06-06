<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Job;
use App\Models\Company;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        $tenDaysAgo = Carbon::now()->subDays(10);

        return Inertia::render('IndexPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'recentJobs' => Job::with('company')
                ->where('created_at', '>=', $tenDaysAgo)
                ->latest()
                ->take(5)
                ->get(),
            'recentCompanies' => Company::where('created_at', '>=', $tenDaysAgo)
                ->latest()
                ->take(5)
                ->get(),
            'totalJobs' => Job::count(),
            'totalCompanies' => Company::count(),
        ]);
    }
}
