<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#SliderCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Slider
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="SliderCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Slider1">https://pemkot.kotabogor-api.my.id/Slider</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Slider1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Slider2">https://pemkot.kotabogor-api.my.id/Slider/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Slider2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Slider3">https://pemkot.kotabogor-api.my.id/SliderCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Slider3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Slider4">https://pemkot.kotabogor-api.my.id/SliderUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Slider4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Slider5">https://pemkot.kotabogor-api.my.id/SliderDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Slider5')">Copy</button></td>
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
                            "keterangan": "varchar(100)",
                            "gambar": "varchar(50)",
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