<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#BeritaCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Berita
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="BeritaCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Berita1">https://api.kotabogor.my.id/Berita</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Berita1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Berita2">https://api.kotabogor.my.id/Berita/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Berita2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Berita3">https://api.kotabogor.my.id/BeritaCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Berita3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Berita4">https://api.kotabogor.my.id/BeritaUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Berita4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Berita5">https://api.kotabogor.my.id/BeritaDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Berita5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "judul": "varchar(100)", // Request Body
                            "kategori_id": "int(11)", // Request Body
                            "isi": "text", // Request Body
                            "gambar": "varchar(255)", // Request Body
                            "tgl": "date(yyyy-mm-dd)", // Request Body
                            "user_id": "int(11)", // Request Body
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                        "Path to file": "https://api.kotabogor.my.id/storage/images/berita/{file_name}"
                        "Parameter": {
                            "order": "DESC or ASC"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>