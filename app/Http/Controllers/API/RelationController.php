<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Pengguna;
use App\Models\Agenda;
use App\Models\Album;
use App\Models\Banner_Announce;
use App\Models\Berita;
use App\Models\Kat_Berita;
use App\Models\Foto;
use App\Models\Komentar;
use App\Models\Statis;
use App\Models\Kat_Statis;
use App\Models\Video;

class RelationController extends Controller
{
    public function Agenda()
    {
        $agenda = Agenda::with('Pengguna')
            ->select(
                'id',
                'hari',
                'tgl',
                'waktu',
                'lokasi',
                'kegiatan',
                'user_id'
            )
            ->get();

        return response()->json([
            'message' => 'Data agenda With pengguna Loaded Successfully',
            'agenda' => $agenda
        ], Response::HTTP_OK);
    }

    public function AgendaById($id)
    {
        $agenda = Agenda::with('Pengguna')
            ->select(
                'id',
                'hari',
                'tgl',
                'waktu',
                'lokasi',
                'kegiatan',
                'user_id'
            )
            ->where('id', $id)
            ->get();

        return response()->json([
            'message' => 'Data agenda With pengguna Loaded Successfully',
            'agenda' => $agenda
        ], Response::HTTP_OK);
    }

    public function Album()
    {
        $album = Album::with('Pengguna')
            ->select(
                'id',
                'judul',
                'tgl',
                'cover',
                'user_id'
            )->get();

        return response()->json([
            'message' => 'Data album With pengguna Loaded Successfully',
            'album' => $album
        ], Response::HTTP_OK);
    }

    public function AlbumById($id)
    {
        $album = Album::with('Pengguna')
            ->select(
                'id',
                'judul',
                'tgl',
                'cover',
                'user_id'
            )
            ->where('id', $id)
            ->get();

        return response()->json([
            'message' => 'Data album With pengguna Loaded Successfully',
            'album' => $album
        ], Response::HTTP_OK);
    }

    public function Banner_Announce()
    {
        $banner = Banner_Announce::with('Pengguna')
            ->select(
                'id',
                'judul',
                'gambar',
                'keterangan',
                'status',
                'link',
                'user_id'
            )->get();

        return response()->json([
            'message' => 'Data banner_announce With pengguna Loaded Successfully',
            'banner_announce' => $banner
        ], Response::HTTP_OK);
    }

    public function Banner_AnnounceById($id)
    {
        $banner = Banner_Announce::with('Pengguna')
            ->select(
                'id',
                'judul',
                'gambar',
                'keterangan',
                'status',
                'link',
                'user_id'
            )
            ->where('id', $id)
            ->get();

        return response()->json([
            'message' => 'Data banner_announce With pengguna Loaded Successfully',
            'banner_announce' => $banner
        ], Response::HTTP_OK);
    }

    public function Berita()
    {
        $berita = Berita::with('Kat_Berita', 'Pengguna')
            ->select(
                'id',
                'judul',
                'kategori_id',
                'isi',
                'gambar',
                'tgl',
                'user_id'
            )->get();

        return response()->json([
            'message' => 'Data berita With kategori & pengguna Loaded Successfully',
            'berita' => $berita
        ], Response::HTTP_OK);
    }
    
    public function BeritaPublic(Request $request)
    {
        $berita = Berita::with('Kat_Berita', 'Pengguna')
            ->select(
                'id',
                'judul',
                'kategori_id',
                'isi',
                'gambar',
                'tgl',
                'user_id'
            );

        if ($request->search) {
            $berita->where('judul', 'like', '%' . $request->search . '%')
                ->orWhere('isi', 'like', '%' . $request->search . '%');
        }

        $show = $berita->paginate(6);

        return response()->json([
            'message' => 'Data berita With kategori & pengguna Loaded Successfully',
            'berita' => $show
        ], Response::HTTP_OK);
    }

    public function BeritaById($id)
    {
        $berita = Berita::with('Kat_Berita', 'Pengguna')
            ->select(
                'id',
                'judul',
                'kategori_id',
                'isi',
                'gambar',
                'tgl',
                'user_id'
            )
            ->where('id', $id)
            ->get();

        return response()->json([
            'message' => 'Data berita With kategori & pengguna Loaded Successfully',
            'berita' => $berita
        ], Response::HTTP_OK);
    }

    public function Foto()
    {
        $foto = Foto::with('Album')
            ->select(
                'id',
                'album_id',
                'judul',
                'foto',
                'keterangan'
            )->get();

        return response()->json([
            'message' => 'Data foto With album Loaded Successfully',
            'foto' => $foto
        ], Response::HTTP_OK);
    }

    public function FotoById($id)
    {
        $foto = Foto::with('Album')
            ->select(
                'id',
                'album_id',
                'judul',
                'foto',
                'keterangan'
            )
            ->where('id', $id)
            ->get();

        return response()->json([
            'message' => 'Data foto With album Loaded Successfully',
            'foto' => $foto
        ], Response::HTTP_OK);
    }

    public function Komentar()
    {
        $komentar = Berita::with('Komentar')
            ->select(
                'id',
                'judul',
                'kategori_id',
                'isi',
                'gambar',
                'tgl',
                'user_id'
            )->get();

        return response()->json([
            'message' => 'Data foto With album Loaded Successfully',
            'berita' => $komentar
        ], Response::HTTP_OK);
    }

    public function KomentarById($id)
    {
        $komentar = Berita::with('Komentar')
            ->select(
                'id',
                'judul',
                'kategori_id',
                'isi',
                'gambar',
                'tgl',
                'user_id'
            )
            ->where('id', $id)
            ->get();

        return response()->json([
            'message' => 'Data foto With album Loaded Successfully',
            'berita' => $komentar
        ], Response::HTTP_OK);
    }

    public function Statis()
    {
        $statis = Statis::with('Kat_Statis', 'Pengguna')
            ->select(
                'id',
                'judul',
                'kategori_id',
                'isi',
                'file',
                'tgl',
                'status',
                'user_id'
            )->get();

        return response()->json([
            'message' => 'Data foto With album Loaded Successfully',
            'statis' => $statis
        ], Response::HTTP_OK);
    }

    public function StatisById($id)
    {
        $statis = Statis::with('Kat_Statis', 'Pengguna')
            ->select(
                'id',
                'judul',
                'kategori_id',
                'isi',
                'file',
                'tgl',
                'status',
                'user_id'
            )
            ->where('id', $id)
            ->get();

        return response()->json([
            'message' => 'Data foto With album Loaded Successfully',
            'statis' => $statis
        ], Response::HTTP_OK);
    }

    public function Video()
    {
        $video = Video::with('Pengguna')
            ->select(
                'id',
                'judul',
                'cover',
                'link',
                'keterangan',
                'user_id'
            )->get();

        return response()->json([
            'message' => 'Data foto With album Loaded Successfully',
            'video' => $video
        ], Response::HTTP_OK);
    }

    public function VideoById($id)
    {
        $video = Video::with('Pengguna')
            ->select(
                'id',
                'judul',
                'cover',
                'link',
                'keterangan',
                'user_id'
            )
            ->where('id', $id)
            ->get();

        return response()->json([
            'message' => 'Data foto With album Loaded Successfully',
            'video' => $video
        ], Response::HTTP_OK);
    }
}
