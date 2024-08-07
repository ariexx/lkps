@extends("adminlte::page")

@section("title", "Kerjasama Penelitian")

@section("content_header")
    <h1>Kerjasama Penelitian</h1>
@stop

@section("content")
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <x-adminlte-card title="Kerjasama Penelitian">
        <a href="{{ route('superadmin.tata-pamong-tata-kelola-kerjasama.kerjasama-penelitian.create') }}" class="btn btn-success mb-3">Tambah Kerjasama Penelitian</a>
        <x-adminlte-datatable id="kerjasama-penelitian-datatable" :heads="$heads">
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->lembaga }}</td>
                    <td>{{ ($item->internasional) ? "Ya" : "Tidak" }}</td>
                    <td>{{ ($item->nasional) ? "Ya" : "Tidak" }}</td>
                    <td>{{ ($item->lokal) ? "Ya" : "Tidak" }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->manfaat }}</td>
                    <td>{{ $item->durasi }}</td>
                    <td>
                        <a href="{{ asset('storage/' . $item->bukti) }}" class="btn btn-sm btn-primary">Lihat Bukti</a>
                    </td>
                    <td>{{ $item->tahun_kerjasama }}</td>
                    <td>{{($item->is_approved) ? "Disetujui" : "Tidak disetujui" }}</td>
                    <td>
                        <x-adminlte-button theme="info" label="Edit" icon="fas fa-edit"/>
                        <x-adminlte-button theme="danger" label="Hapus" icon="fas fa-trash"/>
                        <x-adminlte-button theme="success" label="Setujui" icon="fas fa-check"/>
                        <x-adminlte-button theme="warning" label="Tolak" icon="fas fa-times"/>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </x-adminlte-card>
@endsection
