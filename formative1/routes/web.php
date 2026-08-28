<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/student-home', function () {
    return view('student-home');
})->name('student-home');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/skills', function () {
    return view('skills');
})->name('skills');

Route::get('/student', function () {
    return view("student", ['name' => "Glenn Naguimbing", 'program' => 'BS Information Technology', 'year_level' => '4', 'section' => '4ITE']);
})->name('student');

Route::get('/profile', function () {
    return view("profile", ['student_number' => 2023186440, 'name' => 'Karl Joseph D. Atienza', 'program' => 'BS Information Technology', 'year_level' => '4', 'email' => 'karljoseph.atienza.cics@ust.edu.ph', 'city' => 'Manila', 'fave_programming_language' => 'JavaScript']);
})->name('profile');

Route::get('/welcome/{name}/{course}', function (string $name, string $course) {
    return view('welcome', ['name' => $name, 'course' => $course]);
})->name('welcome');

Route::get('/status', function () {
    return view('status', ['status' => 'unknown']);
})->name('status');

Route::get('/result', function () {
    return view('result', ['grade' => 101]);
})->name('result');


Route::get('/languages', function () {
    $programming_languages = ['JavaScript', 'Python', 'Java', 'C++', 'Ruby'];
    return view('languages', compact('programming_languages'));
})->name('languages');


Route::get('/students', function () {
    $students = [
        ['name' => 'Karl Joseph D. Atienza', 'program' => 'BSIT', 'grade' => 95],
        ['name' => 'Wayne Rigsby', 'program' => 'BSIS', 'grade' => 75],
        ['name' => 'Kimball Cho', 'program' => 'BSCS', 'grade' => 85],
        ['name' => 'Patrick Jane', 'program' => 'BSIT', 'grade' => 99],
        ['name' => 'Grace Van Pelt', 'program' => 'BSIT', 'grade' => 92],
    ];
    return view('students', compact('students'));
})->name('students');


Route::get('/announcements', function () {
    $announcements = [['title' => 'Announcement 1', 'content' => 'This is the content of Announcement 1.'], ['title' => 'Announcement 2', 'content' => 'This is the content of Announcement 2.'], ['title' => 'Announcement 3', 'content' => 'This is the content of Announcement 3.']];
    return view('announcements', compact('announcements'));
})->name('announcements');

Route::get('/slot-home', function () {
    return view('slot-home');
})->name('slot-home');

Route::get('/slot-profile', function () {

    return view('slot-profile', ['name' => 'Karl Joseph D. Atienza', 'program' => 'BS Information Technology', 'year_level' => '4', 'section' => '4ITE']);
})->name('slot-profile');

Route::get('/slot-subjects', function () {
    $subjects = [['title' => 'ITELEC3C'], ['title' => 'IT26210'], ['title' => 'IT26211'], ['title' => 'ICS26016'], ['title' => 'F-ELECN']];
    return view('slot-subjects', compact('subjects'));
})->name('slot-subjects');

Route::get('/slot-contact', function () {
    return view('slot-contact');
})->name('slot-contact');
