<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AgendaController;
use App\Http\Controllers\API\AlbumController;
use App\Http\Controllers\API\Banner_AnnounceController;
use App\Http\Controllers\API\Banner_LinkController;
use App\Http\Controllers\API\BeritaController;
use App\Http\Controllers\API\DataOPDController;
use App\Http\Controllers\API\DokumenController;
use App\Http\Controllers\API\FotoController;
use App\Http\Controllers\API\KatBeritaController;
use App\Http\Controllers\API\KatStatisController;
use App\Http\Controllers\API\KomentarController;
use App\Http\Controllers\API\LinkInfoController;
use App\Http\Controllers\API\PenggunaController;
use App\Http\Controllers\API\SliderController;
use App\Http\Controllers\API\StatisController;
use App\Http\Controllers\API\VideoController;
use App\Http\Controllers\API\VisitorController;
use App\Http\Controllers\API\RelationController;

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/index', [AuthController::class, 'index']);
    Route::get('/indexAdmin', [AuthController::class, 'indexAdmin']);

    // Table Agenda
    Route::get('/Agenda', [AgendaController::class, 'view']);
    Route::get('/Agenda/{id}', [AgendaController::class, 'viewById']);
    Route::post('/AgendaCrt', [AgendaController::class, 'create']);
    Route::put('/AgendaUpd/{id}', [AgendaController::class, 'update']);
    Route::delete('/AgendaDest/{id}', [AgendaController::class, 'destroy']);

    // Table Album
    Route::get('/Album', [AlbumController::class, 'view']);
    Route::get('/Album/{id}', [AlbumController::class, 'viewById']);
    Route::post('/AlbumCrt', [AlbumController::class, 'create']);
    Route::put('/AlbumUpd/{id}', [AlbumController::class, 'update']);
    Route::delete('/AlbumDest/{id}', [AlbumController::class, 'destroy']);

    // Table Banner_Announce
    Route::get('/Banner_Announce', [Banner_AnnounceController::class, 'view']);
    Route::get('/Banner_Announce/{id}', [Banner_AnnounceController::class, 'viewById']);
    Route::post('/Banner_AnnounceCrt', [Banner_AnnounceController::class, 'create']);
    Route::put('/Banner_AnnounceUpd/{id}', [Banner_AnnounceController::class, 'update']);
    Route::delete('/Banner_AnnounceDest/{id}', [Banner_AnnounceController::class, 'destroy']);

    // Table Banner_Link
    Route::get('/Banner_Link', [Banner_LinkController::class, 'view']);
    Route::get('/Banner_Link/{id}', [Banner_LinkController::class, 'viewById']);
    Route::post('/Banner_LinkCrt', [Banner_LinkController::class, 'create']);
    Route::put('/Banner_LinkUpd/{id}', [Banner_LinkController::class, 'update']);
    Route::delete('/Banner_LinkDest/{id}', [Banner_LinkController::class, 'destroy']);

    // Table Berita
    Route::get('/Berita', [BeritaController::class, 'view']);
    Route::get('/Berita/{id}', [BeritaController::class, 'viewById']);
    Route::post('/BeritaCrt', [BeritaController::class, 'create']);
    Route::put('/BeritaUpd/{id}', [BeritaController::class, 'update']);
    Route::delete('/BeritaDest/{id}', [BeritaController::class, 'destroy']);

    // Table DataOPD
    Route::get('/DataOPD', [DataOPDController::class, 'view']);
    Route::get('/DataOPD/{id}', [DataOPDController::class, 'viewById']);
    Route::post('/DataOPDCrt', [DataOPDController::class, 'create']);
    Route::put('/DataOPDUpd/{id}', [DataOPDController::class, 'update']);
    Route::delete('/DataOPDDest/{id}', [DataOPDController::class, 'destroy']);

    // Table Dokumen
    Route::get('/Dokumen', [DokumenController::class, 'view']);
    Route::get('/Dokumen/{id}', [DokumenController::class, 'viewById']);
    Route::post('/DokumenCrt', [DokumenController::class, 'create']);
    Route::put('/DokumenUpd/{id}', [DokumenController::class, 'update']);
    Route::delete('/DokumenDest/{id}', [DokumenController::class, 'destroy']);

    // Table Foto
    Route::get('/Foto', [FotoController::class, 'view']);
    Route::get('/Foto/{id}', [FotoController::class, 'viewById']);
    Route::post('/FotoCrt', [FotoController::class, 'create']);
    Route::put('/FotoUpd/{id}', [FotoController::class, 'update']);
    Route::delete('/FotoDest/{id}', [FotoController::class, 'destroy']);

    //Table KatBerita
    Route::get('/KatBerita', [KatBeritaController::class, 'view']);
    Route::get('/KatBerita/{id}', [KatBeritaController::class, 'viewById']);
    Route::post('/KatBeritaCrt', [KatBeritaController::class, 'create']);
    Route::put('/KatBeritaUpd/{id}', [KatBeritaController::class, 'update']);
    Route::delete('/KatBeritaDest/{id}', [KatBeritaController::class, 'destroy']);

    // Table KatStatis
    Route::get('/KatStatis', [KatStatisController::class, 'view']);
    Route::get('/KatStatis/{id}', [KatStatisController::class, 'viewById']);
    Route::post('/KatStatisCrt', [KatStatisController::class, 'create']);
    Route::put('/KatStatisUpd/{id}', [KatStatisController::class, 'update']);
    Route::delete('/KatStatisDest/{id}', [KatStatisController::class, 'destroy']);

    // Table Komentar
    Route::get('/Komentar', [KomentarController::class, 'view']);
    Route::get('/Komentar/{id}', [KomentarController::class, 'viewById']);
    Route::post('/KomentarCrt', [KomentarController::class, 'create']);
    Route::put('/KomentarUpd/{id}', [KomentarController::class, 'update']);
    Route::delete('/KomentarDest/{id}', [KomentarController::class, 'destroy']);

    // Table LinkInfo
    Route::get('/LinkInfo', [LinkInfoController::class, 'view']);
    Route::get('/LinkInfo/{id}', [LinkInfoController::class, 'viewById']);
    Route::post('/LinkInfoCrt', [LinkInfoController::class, 'create']);
    Route::put('/LinkInfoUpd/{id}', [LinkInfoController::class, 'update']);
    Route::delete('/LinkInfoDest/{id}', [LinkInfoController::class, 'destroy']);

    // Table Pengguna
    Route::get('/Pengguna', [PenggunaController::class, 'view']);
    Route::get('/Pengguna/{id}', [PenggunaController::class, 'viewById']);
    Route::post('/PenggunaCrt', [PenggunaController::class, 'create']);
    Route::put('/PenggunaUpd/{id}', [PenggunaController::class, 'update']);
    Route::delete('/PenggunaDest/{id}', [PenggunaController::class, 'destroy']);

    // Table Slider
    Route::get('/Slider', [SliderController::class, 'view']);
    Route::get('/Slider/{id}', [SliderController::class, 'viewById']);
    Route::post('/SliderCrt', [SliderController::class, 'create']);
    Route::put('/SliderUpd/{id}', [SliderController::class, 'update']);
    Route::delete('/SliderDest/{id}', [SliderController::class, 'destroy']);

    // Table Statis
    Route::get('/Statis', [StatisController::class, 'view']);
    Route::get('/Statis/{id}', [StatisController::class, 'viewById']);
    Route::post('/StatisCrt', [StatisController::class, 'create']);
    Route::put('/StatisUpd/{id}', [StatisController::class, 'update']);
    Route::delete('/StatisDest/{id}', [StatisController::class, 'destroy']);

    // Table Video
    Route::get('/Video', [VideoController::class, 'view']);
    Route::get('/Video/{id}', [VideoController::class, 'viewById']);
    Route::post('/VideoCrt', [VideoController::class, 'create']);
    Route::put('/VideoUpd/{id}', [VideoController::class, 'update']);
    Route::delete('/VideoDest/{id}', [VideoController::class, 'destroy']);

    //Table Visitor
    Route::get('/Visitor', [VisitorController::class, 'view']);
    Route::get('/Visitor/{id}', [VisitorController::class, 'viewById']);
    Route::post('/VisitorCrt', [VisitorController::class, 'create']);
    Route::put('/VisitorUpd/{id}', [VisitorController::class, 'update']);
    Route::delete('/VisitorDest/{id}', [VisitorController::class, 'destroy']);

    // Relational Table Route
    Route::get('/Relation/Agenda', [RelationController::class, 'Agenda']);
    Route::get('/Relation/Agenda/{id}', [RelationController::class, 'AgendaById']);
    Route::get('/Relation/Album', [RelationController::class, 'Album']);
    Route::get('/Relation/Album/{id}', [RelationController::class, 'AlbumById']);
    Route::get('/Relation/Banner_Announce', [RelationController::class, 'Banner_Announce']);
    Route::get('/Relation/Banner_Announce/{id}', [RelationController::class, 'Banner_AnnounceById']);
    Route::get('/Relation/Berita', [RelationController::class, 'Berita']);
    Route::get('/Relation/Berita/{id}', [RelationController::class, 'BeritaById']);
    Route::get('/Relation/Foto', [RelationController::class, 'Foto']);
    Route::get('/Relation/Foto/{id}', [RelationController::class, 'FotoById']);
    Route::get('/Relation/Komentar', [RelationController::class, 'Komentar']);
    Route::get('/Relation/Komentar/{id}', [RelationController::class, 'KomentarById']);
    Route::get('/Relation/Statis', [RelationController::class, 'Statis']);
    Route::get('/Relation/Statis/{id}', [RelationController::class, 'StatisById']);
    Route::get('/Relation/Video', [RelationController::class, 'Video']);
    Route::get('/Relation/Video/{id}', [RelationController::class, 'VideoById']);
});

Route::post('/login', [AuthController::class, 'login']);
