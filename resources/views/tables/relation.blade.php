<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#RelasiCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Relasi
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="RelasiCollapse">
        <div class="card card-body mt-2">

            <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#relasi1Collapse"
                aria-expanded="false">
                <div class="row">
                    <div class="col-6">
                        <div class="text-start" style="font-size: 18px">
                            Tabel Agenda dengan pengguna
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dropdown-logo float-end">
                            <img src="{{ asset('next.png') }}" width="20px">
                        </div>
                    </div>
                </div>
            </a>

            <div class="collapse" id="relasi1Collapse">
                <div class="card card-body mt-2">
                    <table class="mb-2">
                        <tbody class="mb-2">
                            <tr>
                                <td class="col-1" scope="row"><button
                                        class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="agenda01">https://api.kotabogor.my.id/Relation/Agenda</td>
                                <td><button class="btn btn-success float-end" onclick="copy('agenda01')">Copy</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-1" scope="row"><button
                                        class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="agenda02">https://api.kotabogor.my.id/Relation/Agenda/{id}</td>
                                <td><button class="btn btn-success float-end" onclick="copy('agenda02')">Copy</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="hljs-code">
                        <pre>
                            <code class="language-json pt-3" style="margin-left: -270px;">
                                {
                                    "id": "int(11)",
                                    "hari": "varchar(10)",
                                    "tgl": "date(yyyy-mm-dd)",
                                    "waktu": "time(minute:second)",
                                    "lokasi": "varchar(100)",
                                    "kegiatan": "varchar(250)",
                                    "user_id": "int(11)",
                                    "pengguna": {
                                        "id": "int(3)",
                                        "nama": "varchar(50)",
                                        "email": "varchar(50)",
                                        "telp": "varchar(15)",
                                        "username": "varchar(25)",
                                        "role": "varchar(25)",
                                        "foto": "varchar(255)"
                                    }
                                }
                            </code>
                        </pre>
                    </div>
                </div>
            </div>


            <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#relasi2Collapse"
                aria-expanded="false">
                <div class="row">
                    <div class="col-6">
                        <div class="text-start" style="font-size: 18px">
                            Tabel Album dengan Pengguna
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dropdown-logo float-end">
                            <img src="{{ asset('next.png') }}" width="20px">
                        </div>
                    </div>
                </div>
            </a>

            <div class="collapse" id="relasi2Collapse">
                <div class="card card-body mt-2">
                    <table class="mb-2">
                        <tbody class="mb-2">
                            <tr>
                                <td class="col-1" scope="row"><button
                                        class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="album01">https://api.kotabogor.my.id/Relation/Album</td>
                                <td><button class="btn btn-success float-end" onclick="copy('album01')">Copy</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-1" scope="row"><button
                                        class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="album02">https://api.kotabogor.my.id/Relation/Album/{id}</td>
                                <td><button class="btn btn-success float-end" onclick="copy('album02')">Copy</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="hljs-code">
                        <pre>
                            <code class="language-json pt-3" style="margin-left: -270px;">
                                {
                                    "id": "int(11)",
                                    "judul": "varchar(100)",
                                    "tgl": "date(yyyy-mm-dd)",
                                    "cover": "varchar(255)",
                                    "user_id": "int(11)",
                                    "pengguna": {
                                        "id": "int(3)",
                                        "nama": "varchar(50)",
                                        "email": "varchar(50)",
                                        "telp": "varchar(15)",
                                        "username": "varchar(25)",
                                        "role": "varchar(25)",
                                        "foto": "varchar(255)"
                                    }
                                }
                            </code>
                        </pre>
                    </div>
                </div>
            </div>

            <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#relasi3Collapse"
                aria-expanded="false">
                <div class="row">
                    <div class="col-6">
                        <div class="text-start" style="font-size: 18px">
                            Tabel Banner_announce dengan Pengguna
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dropdown-logo float-end">
                            <img src="{{ asset('next.png') }}" width="20px">
                        </div>
                    </div>
                </div>
            </a>

            <div class="collapse" id="relasi3Collapse">
                <div class="card card-body mt-2">
                    <table class="mb-2">
                        <tbody class="mb-2">
                            <tr>
                                <td class="col-1" scope="row"><button
                                        class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="announce01">https://api.kotabogor.my.id/Relation/Banner_Announce</td>
                                <td><button class="btn btn-success float-end" onclick="copy('announce01')">Copy</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-1" scope="row"><button
                                        class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="announce02">https://api.kotabogor.my.id/Relation/Banner_Announce/{id}</td>
                                <td><button class="btn btn-success float-end" onclick="copy('announce02')">Copy</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="hljs-code">
                        <pre>
                            <code class="language-json pt-3" style="margin-left: -270px;">
                                {
                                    "id": "int(11)",
                                    "judul": "varchar(100)",
                                    "gambar": "varchar(255)",
                                    "keterangan": "varchar(250)",
                                    "status": "enum('0','1')",
                                    "link": "varchar(100)",
                                    "user_id": "int(11)",
                                    "pengguna": {
                                        "id": "int(3)",
                                        "nama": "varchar(50)",
                                        "email": "varchar(50)",
                                        "telp": "varchar(15)",
                                        "username": "varchar(25)",
                                        "role": "varchar(25)",
                                        "foto": "varchar(255)"
                                    }
                                }
                            </code>
                        </pre>
                    </div>
                </div>
            </div>

            <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#relasi4Collapse"
                aria-expanded="false">
                <div class="row">
                    <div class="col-6">
                        <div class="text-start" style="font-size: 18px">
                            Tabel Berita dengan Kategori & Pengguna
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dropdown-logo float-end">
                            <img src="{{ asset('next.png') }}" width="20px">
                        </div>
                    </div>
                </div>
            </a>

            <div class="collapse" id="relasi4Collapse">
                <div class="card card-body mt-2">
                    <table class="mb-2">
                        <tbody class="mb-2">
                            <tr>
                                <td class="col-1" scope="row"><button
                                        class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="Berita01">https://api.kotabogor.my.id/Relation/Berita</td>
                                <td><button class="btn btn-success float-end" onclick="copy('Berita01')">Copy</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-1" scope="row"><button
                                        class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="Berita02">https://api.kotabogor.my.id/Relation/Berita/{id}</td>
                                <td><button class="btn btn-success float-end" onclick="copy('Berita02')">Copy</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="hljs-code">
                        <pre>
                            <code class="language-json pt-3" style="margin-left: -270px;">
                                {
                                    "id": "int(11)",
                                    "judul": "varchar(100)",
                                    "kategori_id": "int(11)",
                                    "isi": "text",
                                    "gambar": "varchar(255)",
                                    "tgl": "date(yyyy-mm-dd)",
                                    "user_id": "int(11)",
                                    "kat_berita": {
                                        "id": "int(11)",
                                        "kategori": "varchar(25)",
                                        "keterangan": "varchar(100)"
                                    }
                                    "pengguna": {
                                        "id": "int(3)",
                                        "nama": "varchar(50)",
                                        "email": "varchar(50)",
                                        "telp": "varchar(15)",
                                        "username": "varchar(25)",
                                        "role": "varchar(25)",
                                        "foto": "varchar(255)"
                                    }
                                }
                            </code>
                        </pre>
                    </div>
                </div>
            </div>

            <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#relasi5Collapse"
                aria-expanded="false">
                <div class="row">
                    <div class="col-6">
                        <div class="text-start" style="font-size: 18px">
                            Tabel Foto dengan Album
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dropdown-logo float-end">
                            <img src="{{ asset('next.png') }}" width="20px">
                        </div>
                    </div>
                </div>
            </a>

            <div class="collapse" id="relasi5Collapse">
                <div class="card card-body mt-2">
                    <table class="mb-2">
                        <tbody class="mb-2">
                            <tr>
                                <td class="col-1" scope="row"><button class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="Foto01">https://api.kotabogor.my.id/Relation/Foto</td>
                                <td><button class="btn btn-success float-end" onclick="copy('Foto01')">Copy</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-1" scope="row"><button class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="Foto02">https://api.kotabogor.my.id/Relation/Foto/{id}</td>
                                <td><button class="btn btn-success float-end" onclick="copy('Foto02')">Copy</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="hljs-code">
                        <pre>
                            <code class="language-json pt-3" style="margin-left: -270px;">
                                {
                                    "id": "int(11)",
                                    "album_id": "int(11)",
                                    "isi": "text",
                                    "judul": "varchar(100)",
                                    "foto": "varchar(255)",
                                    "keterangan": "varchar(100)",
                                    "album": {
                                        "id": "int(11)",
                                        "judul": "varchar(100)",
                                        "tgl": "date(yyyy-mm-dd)"
                                        "kategori": "varchar(25)",
                                        "keterangan": "varchar(100)"
                                    }
                                }
                            </code>
                        </pre>
                    </div>
                </div>
            </div>

            <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#relasi6Collapse"
                aria-expanded="false">
                <div class="row">
                    <div class="col-6">
                        <div class="text-start" style="font-size: 18px">
                            Tabel Komentar pada Berita
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dropdown-logo float-end">
                            <img src="{{ asset('next.png') }}" width="20px">
                        </div>
                    </div>
                </div>
            </a>

            <div class="collapse" id="relasi6Collapse">
                <div class="card card-body mt-2">
                    <table class="mb-2">
                        <tbody class="mb-2">
                            <tr>
                                <td class="col-1" scope="row"><button class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="komentar01">https://api.kotabogor.my.id/Relation/Komentar</td>
                                <td><button class="btn btn-success float-end" onclick="copy('komentar01')">Copy</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-1" scope="row"><button class="btn btn-outline-success pe-none">GET</button></td>
                                <td id="komentar02">https://api.kotabogor.my.id/Relation/Komentar/{id}</td>
                                <td><button class="btn btn-success float-end" onclick="copy('komentar02')">Copy</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="hljs-code">
                        <pre>
                            <code class="language-json pt-3" style="margin-left: -270px;">
                                {
                                    "id": "int(11)",
                                    "judul": "varchar(100)",
                                    "kategori_id": "int(11)",
                                    "isi": "text",
                                    "gambar": "varchar(255)",
                                    "tgl": "date(yyyy-mm-dd)",
                                    "user_id": "int(11)",
                                    "komentar": {
                                        "id": "int(11)",
                                        "berita_id": "int(11)",
                                        "nama": "varchar(50)",
                                        "email": "varchar(50)",
                                        "komentar": "text"
                                    }
                                }
                            </code>
                        </pre>
                    </div>
                </div>
            </div>

            <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#relasi7Collapse"
                aria-expanded="false">
                <div class="row">
                    <div class="col-6">
                        <div class="text-start" style="font-size: 18px">
                            Tabel Statis dengan Kategori & Pengguna
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dropdown-logo float-end">
                            <img src="{{ asset('next.png') }}" width="20px">
                        </div>
                    </div>
                </div>
            </a>

            <div class="collapse" id="relasi7Collapse">
                <div class="card card-body mt-2">
                    <table class="mb-2">
                        <tbody class="mb-2">
                            <tr>
                                <td class="col-1" scope="row"><button class="btn btn-outline-success pe-none">GET</button>
                                </td>
                                <td id="statis01">https://api.kotabogor.my.id/Relation/Statis</td>
                                <td><button class="btn btn-success float-end" onclick="copy('statis01')">Copy</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-1" scope="row"><button class="btn btn-outline-success pe-none">GET</button>
                                </td>
                                <td id="statis02">https://api.kotabogor.my.id/Relation/Statis/{id}</td>
                                <td><button class="btn btn-success float-end" onclick="copy('statis02')">Copy</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="hljs-code">
                        <pre>
                            <code class="language-json pt-3" style="margin-left: -270px;">
                                {
                                    "id": "int(11)",
                                    "judul": "varchar(100)",
                                    "kategori_id": "int(11)",
                                    "isi": "text",
                                    "file": "varchar(255)",
                                    "tgl": "date(yyyy-mm-dd)",
                                    "status": "enum('0','1')",
                                    "user_id": "int(11)",
                                    "kat_statis": {
                                        "id": "int(11)",
                                        "kategori": "varchar(25)",
                                        "keterangan": "varchar(100)"
                                    }
                                    "pengguna": {
                                        "id": "int(3)",
                                        "nama": "varchar(50)",
                                        "email": "varchar(50)",
                                        "telp": "varchar(15)",
                                        "username": "varchar(25)",
                                        "role": "varchar(25)",
                                        "foto": "varchar(255)"
                                    }
                                }
                            </code>
                        </pre>
                    </div>
                </div>
            </div>

            <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#relasi8Collapse"
                aria-expanded="false">
                <div class="row">
                    <div class="col-6">
                        <div class="text-start" style="font-size: 18px">
                            Tabel Video dengan Pengguna
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dropdown-logo float-end">
                            <img src="{{ asset('next.png') }}" width="20px">
                        </div>
                    </div>
                </div>
            </a>

            <div class="collapse" id="relasi8Collapse">
                <div class="card card-body mt-2">
                    <table class="mb-2">
                        <tbody class="mb-2">
                            <tr>
                                <td class="col-1" scope="row"><button class="btn btn-outline-success pe-none">GET</button>
                                </td>
                                <td id="video01">https://api.kotabogor.my.id/Relation/Video</td>
                                <td><button class="btn btn-success float-end" onclick="copy('video01')">Copy</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-1" scope="row"><button class="btn btn-outline-success pe-none">GET</button>
                                </td>
                                <td id="video02">https://api.kotabogor.my.id/Relation/Video/{id}</td>
                                <td><button class="btn btn-success float-end" onclick="copy('video02')">Copy</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="hljs-code">
                        <pre>
                            <code class="language-json pt-3" style="margin-left: -270px;">
                                {
                                    "id": "int(11)",
                                    "judul": "varchar(100)",
                                    "cover": "varchar(255)",
                                    "link": "varchar(100)",
                                    "keterangan": "varchar(200)",
                                    "user_id": "int(11)",
                                    "pengguna": {
                                        "id": "int(3)",
                                        "nama": "varchar(50)",
                                        "email": "varchar(50)",
                                        "telp": "varchar(15)",
                                        "username": "varchar(25)",
                                        "role": "varchar(25)",
                                        "foto": "varchar(255)"
                                    }
                                }
                            </code>
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
