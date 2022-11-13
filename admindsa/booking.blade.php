@extends('admin.layouts.main', ['title' => 'Reservasi', 'breadcumb' => 'Reservasi'])
@section('content')
    <div class="card">
        <h5 class="card-header">Data Reservasi</h5>
        <div style="padding-left: 2rem; padding-right: 2rem; padding-bottom: 2rem">
            <div class="table-responsive text-nowrap">
                <table class="table" id="bookingTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID</th>
                            <th>Nama Pemilik</th>
                            <th>Plat Nomor</th>
                            <th>Merk Model</th>
                            <th>Tipe Pencucian</th>
                            <th>Detail Pencucian</th>
                            <th>Total</th>
                            <th>Jam</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
