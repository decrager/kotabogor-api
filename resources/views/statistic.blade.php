<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::user()->role == 'admin')
                {{ __('Statistik Pemakaian REST API Website Pemerintah Kota Bogor') }}
            @else
                {{ __('Akses ditolak') }}
            @endif
        </h2>
    </x-slot>

    <script>
        var api = <?php echo $api; ?>;
        var visit = <?php echo $visit; ?>;
        var barChartData = {
            labels: api,
            datasets: [{
                label: 'API Usage',
                backgroundColor: "#6AAAFA",
                data: visit
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Total Penggunaan API'
                    }
                }
            });
        };
    </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (Auth::user()->role == 'admin')
                        <div class="panel-body">
                            <canvas id="canvas" height="200" width="500"></canvas>
                        </div>
                        <hr class="my-3">
                        <div class="row col-12 mb-2">
                            <div class="col-6 d-flex">
                                <div class="row text-start justify-content-center align-self-center ml-3"
                                    style="font-size: 20px;">
                                    Usage Counter
                                </div>
                            </div>
                            <div class="col-6">
                                <form action="/statistic">
                                    <div class="justify-content-end float-end input-group">
                                        <input type="date" name="date" value="{{ request('date') }}"
                                            style="border-color: darkgray; border-radius: 5px; margin-right= 5px;">
                                        <input type="text" placeholder="Search API.." name="api"
                                            value="{{ request('api') }}"
                                            style="border-color: darkgray; border-radius: 5px 0px 0px 5px;">
                                        <button class="btn btn-light"
                                            style="border-color: darkgray; border-radius: 0px 5px 5px 0px;"
                                            type="submit">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col text-center">No.</th>
                                        <th scope="col">API</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col" class="col text-center">Total Usage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($data->currentPage() > 1) {
                                        $i = $data->currentPage() * 20 - 19;
                                    } else {
                                        $i = 1;
                                    }
                                    ?>
                                    @foreach ($data as $item)
                                        <tr>
                                            <th scope="row" class="col-1 text-center">{{ $i }}</th>
                                            <td>{{ $item->api }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td scope="row" class="col-2 text-center">{{ $item->visit }}</td>
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
