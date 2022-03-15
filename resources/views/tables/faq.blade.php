<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#FaqCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel FAQ
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="FaqCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Faq1">https://api.kotabogor.my.id/Faq</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Faq1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Faq2">https://api.kotabogor.my.id/Faq/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Faq2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Faq3">https://api.kotabogor.my.id/FaqCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Faq3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-primary pe-none">PUT</button></td>
                        <td id="Faq4">https://api.kotabogor.my.id/FaqUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Faq4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Faq5">https://api.kotabogor.my.id/FaqDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Faq5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "pertanyaan": "text",
                            "jawaban": "text",
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>