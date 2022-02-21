<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#agendaCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Agenda
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="agendaCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="agenda1">https://pemkot.kotabogor-api.my.id/Agenda</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('agenda1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="agenda2">https://pemkot.kotabogor-api.my.id/Agenda/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('agenda2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="agenda3">https://pemkot.kotabogor-api.my.id/AgendaCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('agenda3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-primary pe-none">PUT</button></td>
                        <td id="agenda4">https://pemkot.kotabogor-api.my.id/AgendaUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('agenda4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="agenda5">https://pemkot.kotabogor-api.my.id/AgendaDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('agenda5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "hari": "varchar(10)",
                            "tgl": "date(yyyy-mm-dd)",
                            "waktu": "time(minute:second)",
                            "lokasi": "varchar(100)",
                            "kegiatan": "varchar(250)",
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