<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/genre', [ApiController::class, 'genre']);
Route::get('/type', [ApiController::class, 'type']);
Route::get('/status', [ApiController::class, 'status']);
Route::get('/theme', [ApiController::class, 'theme']);

// dashboard
Route::get('/manga_popular', [ApiController::class, 'manga_popular']);
Route::get('/manga_terbaru', [ApiController::class, 'manga_terbaru']);
Route::get('/manga_color', [ApiController::class, 'manga_color']);
Route::get('/manga_bw', [ApiController::class, 'manga_bw']);

// key = type - genre - status - konten - demografis
// type = Manga - Manhwa - Manhua
// genre = Action, Adventure, Boys-Love, Comedy, Crime, Drama, Fantasy, Girls-Love, Harem, Historical, Horror, Isekai, Magical-Girls, Mecha, Medical, Music, Mystery, Philosophical, Psychological, Romance, Sci-Fi, Shoujo-Ai, Shounen-Ai, Slice-of-Life, Sports, Superhero, Thriller, Tragedy, Wuxia, Yuri
// status = Ongoing - Completed
// konten = Ecchi - Gore - Sexual Violence - Smut
// demografis = Josei - Seinen - Shoujo - Shounen
Route::get('/manga_query_dashboard/{key}/{value}', [ApiController::class, 'manga_query_dashboard']); 
Route::get('/manga_search/{search}', [ApiController::class, 'manga_search']);
// end_dashboard

Route::get('/manga_color_page/{page}', [ApiController::class, 'manga_color_page']);
Route::get('/manga_black_and_white_page/{page}', [ApiController::class, 'manga_black_and_white_page']);
Route::get('/manga_terbaru_page/{page}', [ApiController::class, 'manga_terbaru_page']);
Route::get('/manga_type_page/{type}/{page}', [ApiController::class, 'manga_type_page']);
Route::get('/manga_genre_page/{genre}/{page}', [ApiController::class, 'manga_genre_page']);
Route::get('/manga_status_page/{status}/{page}', [ApiController::class, 'manga_status_page']);
Route::get('/manga_theme_page/{theme}/{page}', [ApiController::class, 'manga_theme_page']);
Route::get('/manga_konten_page/{konten}/{page}', [ApiController::class, 'manga_konten_page']);

Route::get('/manga_all_page/{page}', [ApiController::class, 'manga_all_page']);


Route::get('/manga_detail/{url}', [ApiController::class, 'manga_detail']);
Route::get('/manga_read/{url}', [ApiController::class, 'manga_read']);





