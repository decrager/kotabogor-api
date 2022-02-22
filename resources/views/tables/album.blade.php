<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#AlbumCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Album
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="AlbumCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Album1">https://pemkot.kotabogor-api.my.id/Album</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Album1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Album2">https://pemkot.kotabogor-api.my.id/Album/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Album2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Album3">https://pemkot.kotabogor-api.my.id/AlbumCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Album3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Album4">https://pemkot.kotabogor-api.my.id/AlbumUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Album4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Album5">https://pemkot.kotabogor-api.my.id/AlbumDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Album5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "judul": "varchar(100)",
                            "tgl": "date(yyyy-mm-dd)",
                            "cover": "varchar(255)",
                            "user_id": "int(11)",
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>