<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::User()->role == 'admin')
                {{ __('Daftar Pengguna REST API Yang Terdaftar') }}
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
                        Registered User Table Should Be Here
                    @else
                        Anda tidak memiliki izin untuk mengakses halaman ini.
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
