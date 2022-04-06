<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#VideoCollapse"
        aria-expanded="false">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Tabel Video
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="VideoCollapse">
        <div class="card card-body mt-2"> 
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Video1">https://api.kotabogor.my.id/Video</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Video1')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="Video2">https://api.kotabogor.my.id/Video/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Video2')">Copy</button></td>
                    </tr>
                    @if (Auth::user()->role=='admin')
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Video3">https://api.kotabogor.my.id/VideoCrt</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Video3')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="Video4">https://api.kotabogor.my.id/VideoUpd/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Video4')">Copy</button></td>
                    </tr>
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-danger pe-none">DELETE</button></td>
                        <td id="Video5">https://api.kotabogor.my.id/VideoDest/{id}</td>
                        <td><button class="btn btn-success float-end"
                                onclick="copy('Video5')">Copy</button></td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "id": "int(11)",
                            "judul": "varchar(80)", // Request Body
                            "cover": "varchar(255)", // Request Body
                            "link": "varchar(100)", // Request Body
                            "keterangan": "varchar(200)", // Request Body
                            "user_id": "int(11)", // Request Body
                            "created_at": "Timestamp",
                            "updated_at": "Timestamp"
                        }
                        "Path to file": "https://api.kotabogor.my.id/storage/images/video/{file_name}"
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>