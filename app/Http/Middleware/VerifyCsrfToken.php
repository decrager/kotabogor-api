<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/loginAPI','/logout',
        '/AgendaCrt','/AgendaUpd/*','/AgendaDest/*',
        '/AlbumCrt','/AlbumUpd/*','/AlbumDest/*',
        '/Banner_AnnounceCrt','/Banner_AnnounceUpd/*','/Banner_AnnounceDest/*',
        '/Banner_LinkCrt','/Banner_LinkUpd/*','/Banner_LinkDest/*',
        '/BeritaCrt','/BeritaUpd/*','/BeritaDest/*',
        '/DataOPDCrt','/DataOPDUpd/*','/DataOPDDest/*',
        '/DokumenCrt','/DokumenUpd/*','/DokumenDest/*',
        '/FotoCrt','/FotoUpd/*','/FotoDest/*',
        '/KatBeritaCrt','/KatBeritaUpd/*','/KatBeritaDest/*',
        '/KatStatisCrt','/KatStatisUpd/*','/KatStatisDest/*',
        '/KomentarCrt','/KomentarUpd/*','/KomentarDest/*',
        '/LinkInfoCrt','/LinkInfoUpd/*','/LinkInfoDest/*',
        '/PenggunaCrt','/PenggunaUpd/*','/PenggunaDest/*',
        '/SliderCrt','/SliderUpd/*','/SliderDest/*',
        '/StatisCrt','/StatisUpd/*','/StatisDest/*',
        '/VideoCrt','/VideoUpd/*','/VideoDest/*',
        '/VisitorCrt','/VisitorUpd/*','/VisitorDest/*',
    ];
}
