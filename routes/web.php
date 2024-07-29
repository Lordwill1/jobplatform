<?php

// use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\job;

Route::get('/', function () {
    return view('home');
});

// Index
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->paginate(3);
    return view('jobs/index', [
        'jobs' => $jobs
    ]);
});

// Create Job
Route::get('/jobs/create', function () {
    return view('jobs/create');
});

// Show Job
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs/show', ['job' => $job]);
});

// Store
Route::post('/jobs', function () {
    request()-> validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');

});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs/edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    // validate
    request()-> validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    // authorize (on hold...)

    // update the job
    $job = Job::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    // redirect to the job page
    return redirect('/jobs/' . $job->$id);
});

// Destroy
Route::delete('/jobs/{id}', function ($id) {
    // authorize (On hold...)

    // delete the job
    Job::findOrFail($id)->delete();

    // redirect to the job page
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});