<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Foto;
use App\Models\Album;
use App\Models\Video;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Statis;
use App\Models\Counter;
use App\Models\Komentar;
use App\Models\Pengguna;
use App\Models\Kat_Berita;
use App\Models\Kat_Statis;
use Illuminate\Http\Request;
use App\Models\Banner_Announce;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class RelationController extends Controller
{
    public function counter($API)
    {
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', $API)->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', $API)->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = $API;
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', $API)->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = $API;
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
    }

    public function Agenda(Request $request)
    {
        $this->counter('Relational Agenda');

        $agenda = Agenda::with('Pengguna');

        if ($request->order == 'DESC' or $request->order == 'ASC') {
            $agenda = $agenda->orderBy('id', $request->order);
        }

        $agenda = $agenda->select(
            'id',
            'hari',
            'tgl',
            'waktu',
            'lokasi',
            'kegiatan',
            'user_id'
        )->get();

        return response()->json([
            'message' => 'Data agenda With pengguna Loaded Successfully',
            'agenda' => $agenda
        ], Response::HTTP_OK);
    }

    public function AgendaById($id)
    {
        $this->counter('Relational Agenda');

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

    public function Album(Request $request)
    {
        $this->counter('Relational Album');

        $album = Album::with('Pengguna');

        if ($request->order == 'DESC' or $request->order == 'ASC') {
            $album = $album->orderBy('id', $request->order);
        }

        $album = $album->select(
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
        $this->counter('Relational Album');

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
        $this->counter('Relational Banner Announcement');

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
        $this->counter('Relational Banner Announcement');

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

    public function Berita(Request $request)
    {
        $this->counter('Relational Berita');

        $berita = Berita::with('Kat_berita', 'Pengguna');

        if ($request->order == 'DESC' or $request->order == 'ASC') {
            $berita = $berita->orderBy('id', $request->order);
        }

        $berita = $berita->select(
            'beritas.id',
            'beritas.judul',
            'beritas.kategori_id',
            'beritas.isi',
            'beritas.gambar',
            'beritas.tgl',
            'beritas.status',
            'beritas.user_id'
        );

        if ($request->category) {
            $category = $request->category;
            $show = $berita->join('kat_beritas', 'beritas.kategori_id', '=', 'kat_beritas.id')
                ->where('kat_beritas.kategori', 'like', '%' . $category . '%')->get();
        } else {
            $show = $berita->get();
        }

        return response()->json([
            'message' => 'Data berita With kategori & pengguna Loaded Successfully',
            'berita' => $show
        ], Response::HTTP_OK);
    }

    public function BeritaPublic(Request $request)
    {
        $this->counter('Relational Berita');

        $berita = Berita::with('Kat_berita', 'Pengguna');

        if ($request->order == 'DESC' or $request->order == 'ASC') {
            $berita = $berita->orderBy('id', $request->order);
        } else {
            $berita = $berita->orderBy('id', 'DESC');
        }

        $berita = $berita->select(
            'beritas.id',
            'beritas.judul',
            'beritas.kategori_id',
            'beritas.isi',
            'beritas.gambar',
            'beritas.tgl',
            'beritas.status',
            'beritas.user_id'
        );

        if ($request->search) {
            $berita->where('judul', 'like', '%' . $request->search . '%')
                ->orWhere('isi', 'like', '%' . $request->search . '%');
        }

        if ($request->category) {
            $category = $request->category;
            $show = $berita->join('kat_beritas', 'beritas.kategori_id', '=', 'kat_beritas.id')
                ->where('kat_beritas.kategori', 'like', '%' . $category . '%');
        } else {
            $show = $berita;
        }

        if ($request->perPage) {
            $perPage = $request->perPage;
            $show = $berita->paginate($perPage);
        } else {
            $show = $berita->get();
        }

        return response()->json([
            'message' => 'Data berita With kategori & pengguna Loaded Successfully',
            'berita' => $show
        ], Response::HTTP_OK);
    }

    public function BeritaById($id)
    {
        $this->counter('Relational Berita');

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
        $this->counter('Relational Foto');

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
        $this->counter('Relational Foto');

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
        $this->counter('Relational Komentar');

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
        $this->counter('Relational Komentar');

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
        $this->counter('Relational Statis');

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
        $this->counter('Relational Statis');

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
        $this->counter('Relational Video');

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
        $this->counter('Relational Statis');

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
