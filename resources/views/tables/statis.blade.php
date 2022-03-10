<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#StatisCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Statis
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="StatisCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Statis1">https://api.kotabogor.my.id/Statis</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Statis1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Statis2">https://api.kotabogor.my.id/Statis/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Statis2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Statis3">https://api.kotabogor.my.id/StatisCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Statis3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Statis4">https://api.kotabogor.my.id/StatisUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Statis4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Statis5">https://api.kotabogor.my.id/StatisDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Statis5')">Copy</button></td>
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
                            "kategori_id": "int(11)",
                            "isi": "text",
                            "file": "varchar(255)",
                            "tgl": "date(yyyy-mm-dd)",
                            "status": "enum('0','1')",
                            "user_id": "int(11)",
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                        "Path to file": "https://api.kotabogor.my.id/storage/images/statis/{file_name}"
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>