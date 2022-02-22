<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#DokumenCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Dokumen
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="DokumenCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Dokumen1">https://pemkot.kotabogor-api.my.id/Dokumen</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Dokumen1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Dokumen2">https://pemkot.kotabogor-api.my.id/Dokumen/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Dokumen2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Dokumen3">https://pemkot.kotabogor-api.my.id/DokumenCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Dokumen3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Dokumen4">https://pemkot.kotabogor-api.my.id/DokumenUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Dokumen4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Dokumen5">https://pemkot.kotabogor-api.my.id/DokumenDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Dokumen5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "nama_doc": "varchar(50)",
                            "link": "varchar(100)",
                            "file": "varchar(255)",
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