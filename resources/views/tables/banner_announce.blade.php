<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#Banner_AnnounceCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Banner_Announce
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="Banner_AnnounceCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Banner_Announce1">https://api.kotabogor.my.id/Banner_Announce</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_Announce1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Banner_Announce2">https://api.kotabogor.my.id/Banner_Announce/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_Announce2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Banner_Announce3">https://api.kotabogor.my.id/Banner_AnnounceCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_Announce3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Banner_Announce4">https://api.kotabogor.my.id/Banner_AnnounceUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_Announce4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Banner_Announce5">https://api.kotabogor.my.id/Banner_AnnounceDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Banner_Announce5')">Copy</button></td>
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
                            "gambar": "varchar(255)",
                            "keterangan": "varchar(250)",
                            "status": "enum('0','1')",
                            "link": "varchar(100)",
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