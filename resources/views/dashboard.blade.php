<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('REST API Website Pemerintah Kota Bogor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('tables.loginAPI')
                    @include('tables.agenda')
                    @include('tables.album')
                    @include('tables.banner_announce')
                    @include('tables.banner_link')
                    @include('tables.berita')
                    @include('tables.data_opd')
                    @include('tables.dokumen')
                    @include('tables.faq')
                    @include('tables.foto')
                    @include('tables.katberita')
                    @include('tables.katstatis')
                    @include('tables.komentar')
                    @include('tables.linkinfo')
                    @include('tables.pengguna')
                    @include('tables.slider')
                    @include('tables.statis')
                    @include('tables.video')
                    @include('tables.visitor')
                    @include('tables.relation')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
