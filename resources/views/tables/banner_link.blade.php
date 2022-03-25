<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#Banner_LinkCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Banner Link
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="Banner_LinkCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Banner_Link1">https://api.kotabogor.my.id/Banner_Link</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_Link1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Banner_Link2">https://api.kotabogor.my.id/Banner_Link/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_Link2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Banner_Link3">https://api.kotabogor.my.id/Banner_LinkCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_Link3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Banner_Link4">https://api.kotabogor.my.id/Banner_LinkUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_Link4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Banner_Link5">https://api.kotabogor.my.id/Banner_LinkDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_Link5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "judul": "varchar(100)", // Fillable | Required
                            "gambar": "varchar(255)", // Fillable | Required
                            "link": "varchar(100)", // Fillable | Required
                            "status": "enum('0','1')", // Fillable | Required
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                        "Path to file": "https://api.kotabogor.my.id/storage/images/banner_link/{file_name}"
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>