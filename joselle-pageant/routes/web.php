<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/gallery', function () {
    return view('pages.gallery');
})->name('gallery');

Route::get('/advocacy', function () {
    return view('pages.advocacy');
})->name('advocacy');

Route::get('/journey', function () {
    return view('pages.journey');
})->name('journey');

Route::get('/support', function () {
    return view('pages.support');
})->name('support');

// For support messages
Route::post('/support', function (Request $request) {
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'message' => 'required|string|max:1000',
    ]);

    $submissionData = [
        'name' => $validatedData['name'],
        'message' => $validatedData['message'],
        'submitted_at' => now()->toDateTimeString(),
    ];

    //The Str::slug method generates a URL-friendly "slug" from the given string
    $fileName = 'support_messages/' . time() . '_' . Str::slug($validatedData['name']) . '.json';

    Storage::put($fileName, json_encode($submissionData, JSON_PRETTY_PRINT));


    //The back function generates a redirect HTTP response to the user's previous location:
    return back()->with('success', "Thank you for your support, {$validatedData['name']}! Your message has been received.");


})->name('support.submit');