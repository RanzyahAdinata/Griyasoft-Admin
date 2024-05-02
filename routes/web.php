<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\UserController;
use App\Http\controllers\AbsensiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\StudentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('auth');

Auth::routes();


// Route::group(['middleware' => ['auth']], function () {


//halaman home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::group(['middleware' => ['auth']], function () {
Route::group(['middleware' => ['auth', 'admin', 'verified']], function () {

    //     route::get('/halaman-satu', HomeController::class, 'halamansatu')->name('halaman-satu');
    Route::resource('user', UserController::class);
    Route::post('user/destroy/{id}', [UserController::class, 'delete']);


    //halaman profile
    Route::resource('users/profile', ProfileController::class);

    //update profile
    Route::post('/update-profile-data', [ProfileController::class, 'updateProfileData'])->name('profile.updateData');


    //halaman data siswa pkl
    Route::resource('/siswa', SiswaController::class);
    Route::post('hapus/{id}', [SiswaController::class, 'delete']);
    Route::post('/posts/multi-delete', [SiswaController::class, 'multiDelete'])->name('posts.multi-delete');
    Route::post('/selected-siswa', [SiswaController::class, 'deleteAll'])->name('siswa.delete');

    //hlaman import data siswa
    Route::post('/siswa/importexcel', [SiswaController::class, 'importexcel'])->name('importexcel');

    //halaman students active
    Route::resource('activeStudent', StudentController::class);

    //content slider
    Route::resource('slider', SliderController::class);
    Route::get('slider/{id}/play', [SliderController::class, 'play'])->name('slider.play');
    Route::post('destroy/{id}', [SliderController::class, 'delete']);


    //absensi
    Route::resource('absensi', AbsensiController::class);
    Route::post('hapus/delete/{id}', [AbsensiController::class, 'deleteHapus']);

    //content-blog
    Route::resource('blog', BlogController::class);
    Route::get('/detail-blog/{slug}', [BlogController::class, 'detail'])->name('detail-blog');
    Route::get('blog/{id}/detail-blog', [BlogController::class, 'play'])->name('blog.detail-blog');


    //Kategori
    Route::resource('kategori', KategoriController::class);
    Route::post('kategori/delete/{id}', [KategoriController::class, 'delete']);

    //Courses
    // Route::resource('course', CoursesController::class);
    Route::get('/course', [CourseController::class, 'index'])->name('course.index');
    Route::get('course/{id}/play', [CourseController::class, 'play'])->name('course.play');
    // Route::get('course/play', [CourseController::class, 'playy'])->name('course.play');


    //video
    Route::get('videos', [VideoController::class, 'index'])->name('videos.index');
    Route::get('videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('videos', [VideoController::class, 'store'])->name('videos.store');
    Route::get('videos/{id}/play', [VideoController::class, 'play'])->name('videos.play');
    Route::get('videos/{id}/edit', [VideoController::class, 'edit'])->name('videos.edit');
    Route::put('videos/{id}', [VideoController::class, 'update'])->name('videos.update');
    Route::delete('videos/{id}', [VideoController::class, 'destroy'])->name('videos.destroy');
    Route::post('delete/{id}', [VideoController::class, 'delete']);


    //calender
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('/add-event', [CalendarController::class, 'addEvent'])->name('add.event');
    Route::post('/update-event', [CalendarController::class, 'updateEvent'])->name('update.event');
    Route::post('/delete-event', [CalendarController::class, 'deleteEvent'])->name('delete.event');

});

// Route::group(['middleware' => ['auth', 'checkRole:siswa']], function () {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//     Route::resource('absensi', AbsensiController::class);
// });

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource('user', UserController::class);
    Route::post('user/destroy/{id}', [UserController::class, 'delete']);


    //halaman profile
    Route::resource('users/profile', ProfileController::class);

    //update profile
    Route::post('/update-profile-data', [ProfileController::class, 'updateProfileData'])->name('profile.updateData');


    //halaman data siswa pkl
    Route::resource('/siswa', SiswaController::class);
    Route::post('hapus/{id}', [SiswaController::class, 'delete']);
    Route::post('/posts/multi-delete', [SiswaController::class, 'multiDelete'])->name('posts.multi-delete');
    Route::post('/selected-siswa', [SiswaController::class, 'deleteAll'])->name('siswa.delete');

    //hlaman import data siswa
    Route::post('/siswa/importexcel', [SiswaController::class, 'importexcel'])->name('importexcel');

    //halaman students active
    Route::resource('activeStudent', StudentController::class);

    //content slider
    Route::resource('slider', SliderController::class);
    Route::get('slider/{id}/play', [SliderController::class, 'play'])->name('slider.play');
    Route::post('destroy/{id}', [SliderController::class, 'delete']);


    //absensi
    Route::resource('absensi', AbsensiController::class);
    Route::post('hapus/delete/{id}', [AbsensiController::class, 'deleteHapus']);

    //content-blog
    Route::resource('blog', BlogController::class);
    Route::get('/detail-blog/{slug}', [BlogController::class, 'detail'])->name('detail-blog');
    Route::get('blog/{id}/detail-blog', [BlogController::class, 'play'])->name('blog.detail-blog');


    //Kategori
    Route::resource('kategori', KategoriController::class);
    Route::post('kategori/delete/{id}', [KategoriController::class, 'delete']);

    //Courses
// Route::resource('course', CoursesController::class);
    Route::get('/course', [CourseController::class, 'index'])->name('course.index');
    Route::get('course/{id}/play', [CourseController::class, 'play'])->name('course.play');


    //video
    Route::get('video', [VideoController::class, 'index'])->name('video.index');
    Route::get('video/create', [VideoController::class, 'create'])->name('video.create');
    Route::post('video', [VideoController::class, 'store'])->name('video.store');
    Route::get('video/{id}/play', [VideoController::class, 'play'])->name('video.play');
    Route::get('video/{id}/edit', [VideoController::class, 'edit'])->name('video.edit');
    Route::put('video/{id}', [VideoController::class, 'update'])->name('video.update');
    Route::delete('video/{id}', [VideoController::class, 'destroy'])->name('video.destroy');
    Route::post('delete/{id}', [VideoController::class, 'delete']);


    //calender
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::post('/add-event', [CalendarController::class, 'addEvent'])->name('add.event');
    Route::post('/update-event', [CalendarController::class, 'updateEvent'])->name('update.event');
    Route::post('/delete-event', [CalendarController::class, 'deleteEvent'])->name('delete.event');

});

//halaman profile
Route::resource('users/profile', ProfileController::class);

//update profile
Route::post('/update-profile-data', [ProfileController::class, 'updateProfileData'])->name('profile.updateData');