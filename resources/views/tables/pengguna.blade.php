<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#PenggunaCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Pengguna
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="PenggunaCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Pengguna1">https://api.kotabogor.my.id/Pengguna</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Pengguna1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Pengguna2">https://api.kotabogor.my.id/Pengguna/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Pengguna2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Pengguna3">https://api.kotabogor.my.id/PenggunaCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Pengguna3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Pengguna4">https://api.kotabogor.my.id/PenggunaUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Pengguna4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Pengguna5">https://api.kotabogor.my.id/PenggunaDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Pengguna5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "nama": "varchar(50)",
                            "email": "varchar(50)",
                            "telp": "varchar(15)",
                            "username": "varchar(25)",
                            "password": "varchar(100)",
                            "role": "varchar(25)",
                            "foto": "varchar(255)",
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>