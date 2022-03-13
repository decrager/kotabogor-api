<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::User()->role == 'admin')
                {{ __('Daftar Pengguna REST API Pemerintah Kota Bogor Yang Terdaftar') }}
            @else
                {{ __('Akses ditolak') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (Auth::User()->role == 'admin')
                        <div class="row col-12 mb-2">
                            <div class="col-6">
                                <div class="text-start ml-3" style="font-size: 20px;">
                                    Daftar Pengguna
                                </div>
                            </div>
                            <div class="col-6">
                                <form action="/registeredUser">
                                    <div class="justify-content-end float-end input-group">
                                        <input type="text" placeholder="Search.." name="search"
                                            value="{{ request('search') }}"
                                            style="border-color: darkgray; border-radius: 5px 0px 0px 5px;">
                                        <button class="btn btn-light"
                                            style="border-color: darkgray; border-radius: 0px 5px 5px 0px;"
                                            type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped" width="100%" cellspacing="0">
                                <thead >
                                    <tr>
                                        <th scope="col" class="col text-center">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col">Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data->currentPage() > 1) {
                                        $i = $data->currentPage() * 15 - 14;
                                    } else {
                                        $i = 1;
                                    }
                                    ?>
                                    @foreach ($data as $item)
                                        <tr>
                                            <th scope="row" class="col text-center">{{ $i }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            @if (empty($item->email_verified_at))
                                                <td class="table-danger text-center">
                                                    Not Verified
                                                </td>
                                            @else
                                                <td class="table-success text-center">
                                                    Verified
                                                </td>
                                            @endif
                                            <td>{{ $item->role }}</td>
                                        </tr>
                                        <?php $i = $i + 1; ?>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center">
                                {{ $data->links() }}
                            </div>
                        </div>
                    @else
                        Anda tidak memiliki izin untuk mengakses halaman ini.
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
