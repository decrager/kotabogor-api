<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#KomentarCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Komentar
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="KomentarCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Komentar1">https://api.kotabogor.my.id/Komentar</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Komentar1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Komentar2">https://api.kotabogor.my.id/Komentar/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Komentar2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Komentar3">https://api.kotabogor.my.id/KomentarCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Komentar3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-primary pe-none">PUT</button></td>
                        <td id="Komentar4">https://api.kotabogor.my.id/KomentarUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Komentar4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Komentar5">https://api.kotabogor.my.id/KomentarDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Komentar5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "berita_id": "int(11)", // Fillable | Required
                            "nama": "varchar(50)", // Fillable | Required
                            "email": "varchar(50)", // Fillable | Required
                            "komentar": "text", // Fillable | Required
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>