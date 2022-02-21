<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#Banner_linkCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Banner_link
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="Banner_linkCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Banner_link1">https://pemkot.kotabogor-api.my.id/Banner_link</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_link1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Banner_link2">https://pemkot.kotabogor-api.my.id/Banner_link/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_link2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Banner_link3">https://pemkot.kotabogor-api.my.id/Banner_linkCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_link3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Banner_link4">https://pemkot.kotabogor-api.my.id/Banner_linkUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_link4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Banner_link5">https://pemkot.kotabogor-api.my.id/Banner_linkDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_link5')">Copy</button></td>
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
                            "gambar": "varchar(50)",
                            "link": "varchar(100)",
                            "status": "enum('0','1')",
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>