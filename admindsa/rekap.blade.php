@extends('admin.layouts.main',['title'=>'Data Rekap','breadcumb'=>'Data Rekap'])
@section('content')
  <div class="card">

    <h5 class="card-header">Data Rekap</h5>
    <div class="" style="padding-left: 2rem; padding-bottom: 2rem; padding-right: 2rem;">
      {{-- <button class="btn btn-info" data-bs-toggle="modal"
      data-bs-target="#addEmployee">
        Tambah Data
      </button> --}}
      <form method="POST" id="sortData">
        {{ csrf_field() }}
        <div class="row g-3">
          <div class="col-md-3">
              <input class="datepicker-here form-control digits"  name="date" type="text" id="daterange" data-range="true" data-multiple-dates-separator=" - " data-language="en" autocomplete="off" data-bs-original-title="" title="">
              {{-- <div class="invalid-feedback">Please provide a valid city.</div> --}}
          </div>
          {{-- <div class="col-md-3">
            <select class="form-select" id="validationCustom04" required="">
              <option value="">Choose...</option>
              <option>...</option>
            </select>
          </div> --}}
          <div class="col-md-3 mb-3">
              <div class="btn-group">
                  <button type="submit" class="btn btn-primary">Lihat Data</button>
                  <form action="" method="post">
                    <input type="hidden" name="date" id="exportDate">
                    <a href="{{route('admin.rekap.export')}}" class="btn btn-primary">Export</a>
                  </form>
                  
          </div>
      </form>
      
      </div>
    </div>

    <div style=" padding-bottom: 2rem;">
        <div class="table-responsive text-nowrap">
            <table class="table" id="profitTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Kas</th>
                    <th>Karyawan</th>
                    <th>Pemilik</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
                <tfoot>
                  <tr>
                    <th></th>
                      <th>Total:</th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                  </tr>
              </tfoot>
              </table>
          </div>
    </div>
  </div>
  @endsection