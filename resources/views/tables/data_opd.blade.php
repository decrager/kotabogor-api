<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#DataOPDCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Data OPD
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="DataOPDCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="DataOPD1">https://api.kotabogor.my.id/DataOPD</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('DataOPD1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="DataOPD2">https://api.kotabogor.my.id/DataOPD/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('DataOPD2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="DataOPD3">https://api.kotabogor.my.id/DataOPDCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('DataOPD3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="DataOPD4">https://api.kotabogor.my.id/DataOPDUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('DataOPD4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="DataOPD5">https://api.kotabogor.my.id/DataOPDDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('DataOPD5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(3)",
                            "nama_opd": "varchar(50)", // Request Body
                            "foto_kantor": "varchar(255)", // Request Body
                            "alamat": "varchar(100)", // Request Body
                            "telp": "varchar(15)", // Request Body
                            "email": "varchar(50)", // Request Body
                            "website": "varchar(50)", // Request Body
                            "twitter_link": "varchar(100)", // Request Body
                            "ig_link": "varchar(100)", // Request Body
                            "facebook_link": "varchar(100)", // Request Body
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                        "Path to file": "https://api.kotabogor.my.id/storage/images/opd/{file_name}"
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>