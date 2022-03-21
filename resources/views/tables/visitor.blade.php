<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#VisitorCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Visitor
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="VisitorCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Visitor1">https://api.kotabogor.my.id/Visitor</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Visitor1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Visitor2">https://api.kotabogor.my.id/Visitor/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Visitor2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Visitor3">https://api.kotabogor.my.id/VisitorCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Visitor3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-primary pe-none">PUT</button></td>
                        <td id="Visitor4">https://api.kotabogor.my.id/VisitorUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Visitor4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Visitor5">https://api.kotabogor.my.id/VisitorDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Visitor5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "tgl": "date(yyyy-mm-dd)",
                            "total_visit": "bigint",
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                        "Parameter": {
                            "total" = "1 or 0",
                            "limit" = "num"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>