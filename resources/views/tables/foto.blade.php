<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#FotoCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Foto
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="FotoCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Foto1">https://api.kotabogor.my.id/Foto</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Foto1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Foto2">https://api.kotabogor.my.id/Foto/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Foto2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Foto3">https://api.kotabogor.my.id/FotoCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Foto3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Foto4">https://api.kotabogor.my.id/FotoUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Foto4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Foto5">https://api.kotabogor.my.id/FotoDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Foto5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "album_id": "int(11)",
                            "judul": "varchar(100)",
                            "foto": "varchar(255)",
                            "keterangan": "varchar(200)",
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>