<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#KatStatisCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Kategori Statis
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="KatStatisCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="KatStatis1">https://api.kotabogor.my.id/KatStatis</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('KatStatis1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="KatStatis2">https://api.kotabogor.my.id/KatStatis/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('KatStatis2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="KatStatis3">https://api.kotabogor.my.id/KatStatisCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('KatStatis3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-primary pe-none">PUT</button></td>
                        <td id="KatStatis4">https://api.kotabogor.my.id/KatStatisUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('KatStatis4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="KatStatis5">https://api.kotabogor.my.id/KatStatisDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('KatStatis5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "kategori": "varchar(50)", // Fillable | Required
                            "keterangan": "varchar(50)", // Fillable | Required
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>