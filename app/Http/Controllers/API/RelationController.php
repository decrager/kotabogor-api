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
    public function Agenda()
    {
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Relational Agenda')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Relational Agenda')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Relational Agenda';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Relational Agenda')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Relational Agenda';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter

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
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Relational Album')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Relational Album')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Relational Album';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Relational Album')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Relational Album';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter

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
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Relational Banner Announcement')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Relational Banner Announcement')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Relational Banner Announcement';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Relational Banner Announcement')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Relational Banner Announcement';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter

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

    public function Berita(Request $request)
    {
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Relational Berita')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Relational Berita')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Relational Berita';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Relational Berita')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Relational Berita';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
        $berita = Berita::with('Kat_Berita', 'Pengguna')
            ->select(
                'beritas.id',
                'beritas.judul',
                'beritas.kategori_id',
                'beritas.isi',
                'beritas.gambar',
                'beritas.tgl',
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
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Relational Berita Public')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Relational Berita Public')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Relational Berita Public';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Relational Berita Public')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Relational Berita Public';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
        $berita = Berita::with('Kat_Berita', 'Pengguna')
            ->select(
                'beritas.id',
                'beritas.judul',
                'beritas.kategori_id',
                'beritas.isi',
                'beritas.gambar',
                'beritas.tgl',
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
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Relational Foto')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Relational Foto')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Relational Foto';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Relational Foto')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Relational Foto';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
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
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Relational Komentar')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Relational Komentar')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Relational Komentar';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Relational Komentar')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Relational Komentar';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
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
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Relational Statis')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Relational Statis')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Relational Statis';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Relational Statis')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Relational Statis';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
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
        // Counter
        $today = Carbon::today()->toDateString();
        $check = Counter::select('api', 'tanggal', 'visit')->where('api', 'Relational Video')->where('tanggal', $today)->get();
        $tanggal = Counter::select('tanggal')->where('api', 'Relational Video')->where('tanggal', $today)->first();

        if ($check->isEmpty()) {
            $counter = new Counter;
            $counter->api = 'Relational Video';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        } elseif ($tanggal->tanggal == $today) {
            $counter = Counter::where('api', 'Relational Video')->where('tanggal', $today);
            $counter->increment('visit');
        } elseif ($tanggal->tanggal != $today) {
            $counter = new Counter;
            $counter->api = 'Relational Video';
            $counter->tanggal = $today;
            $counter->visit = 1;
            $counter->save();
        }
        // End Counter
        
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
