<div class="row">
    <a class="d-inline-block bg-white btn py-2" data-bs-toggle="collapse" data-bs-target="#login"
        aria-expanded="false" aria-controls="login">
        <div class="row">
            <div class="col-6">
                <div class="text-start" style="font-size: 20px">
                    Login & Logout
                </div>
            </div>
            <div class="col-6">
                <div class="dropdown-logo float-end">
                    <img src="{{ asset('next.png') }}" width="25px">
                </div>
            </div>
        </div>
    </a>

    <div class="collapse" id="login">
        <div class="card card-body mt-2"><h1 class="mb-1">Login pada Postman terlebih dahulu untuk mendapatkan token</h1>
            <table class="mb-2">
                <tbody class="mb-2">
                    <tr>
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-warning pe-none">POST</button></td>
                        <td id="loginAPI">https://pemkot.kotabogor-api.my.id/loginAPI</td>
                        <td><button class="btn btn-success float-end" onclick="copy('loginAPI')">Copy</button></td>
                    </tr>
                    <tr class="py-2">
                        <td class="col-1" scope="row"><button
                                class="btn btn-outline-success pe-none">GET</button></td>
                        <td id="logoutAPI">https://pemkot.kotabogor-api.my.id/logout</td>
                        <td><button class="btn btn-success float-end" onclick="copy('logoutAPI')">Copy</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="hljs-code">
                <pre>
                    <code class="language-json text-left pt-3">
                        {
                            "email" : "varchar(255)",
                            "password" : "varchar(255)"
                        }
                    </code>
                </pre>
            </div>
        </div>
    </div>
</div>
