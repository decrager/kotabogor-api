<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#LinkInfoCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Link_Info
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="LinkInfoCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="LinkInfo1">https://api.kotabogor.my.id/LinkInfo</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('LinkInfo1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="LinkInfo2">https://api.kotabogor.my.id/LinkInfo/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('LinkInfo2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="LinkInfo3">https://api.kotabogor.my.id/LinkInfoCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('LinkInfo3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="LinkInfo4">https://api.kotabogor.my.id/LinkInfoUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('LinkInfo4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="LinkInfo5">https://api.kotabogor.my.id/LinkInfoDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('LinkInfo5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "judul": "varchar(50)",
                            "keterangan": "varchar(200)",
                            "link": "varchar(100)",
                            "gambar": "varchar(255)",
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>