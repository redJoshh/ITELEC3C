<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/jobs', function () {
    $title = "Job Listings";
    $jobs = [
        ['title' => 'Software Engineer', 'location' => 'New York'],
        ['title' => 'Database Admin', 'location' => 'San Francisco'],
        ['title' => 'Web Developer', 'location' => 'Los Angeles'],
    ];
    // return view('jobs.index', ['title' => "Job Listings"]);
    // return view('jobs.index')->with('title', 'Job Listings');
    return view('jobs.index', compact('title', 'jobs'));
})->name('jobs');


Route::get('/jobs/create', function () {
    return view('jobs.create');
})->name('jobs.create');

Route::get('/users', function () {
    return view("user", ['name' => "John Doe", 'age' => 18]);
});



// Route::match(['GET', 'POST'], '/submit', function () {
//     return " Submitted";
// });

// Route::get('/test', function () {
//     $url = route('jobs');
//     return "<a href='{$url}'>Click Here</a>";
// });

// Route::get('/api/users', function () {
//     return [
//         'name' => "John Doe",
//         'email' => "john@email.com"
//     ];
// });

// Route::get("/posts/{id}", function (string $id) {
//     return "Post  " . $id;
// }); //adding constraint
// Route::get("/posts/{id}/comments/{commentId}", function (string $id, string $commentId) {
//     return "Post  " . $id . " Comment " . $commentId;
// });


// Route::get('/test', function (Request $request) {
//     return [
//         'method' => $request->method(),
//         'url' => $request->url(),
//         'fullUrl' => $request->fullUrl(),
//         'ip' => $request->ip(),
//         'userAgent' => $request->userAgent(),
//         'header' => $request->header(),
//     ];
// });


// Route::get('/users', function (Request $request) {
//     return $request->input('name', 'Default Name');
// });



// Route::get('/notfound', function () {
//     return response("Page Not Found", 404);
// });


// Route::get('/test', function () {
//     // return response('<h1>Hello World</h1>', 200)->header('Content-Type', 'text/html');
//     return response()->json(['name' => 'John Doe'])->cookie('name', 'John Doe');
// });

// Route::get('/download', function () {
//     return response()->download(public_path('favicon.ico'));
// });


// Route::get('/read-cookie', function (Request $request) {
//     $cookieValue = $request->cookie('name');
//     return response()->json(['cookie' => $cookieValue]);
// });