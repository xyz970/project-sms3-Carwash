@extends('admin.layouts.main',['title'=>'Profit','breadcumb'=>'Profit'])
@section('content')
  <div class="card">
    
    <!-- Large Modal -->
    <div class="modal fade" id="profitDetail" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel3">Keuntungan tanggal : <span id="selectedDate"></span></h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form method="POST"  id="insertProfit">
              {{ csrf_field() }}
            <div class="row">
              <div class="col mb-3">
                <label for="daytime" class="form-label">Waktu</label>
                <select  class="form-select" id="daytime" name="daytime">
                  <option value="Sesi 1">Sesi 1 (08:00 -> 11:00)</option>
                  <option value="Sesi 2">Sesi 2 (11:00 -> 16:00)</option>
                  <option value="Sesi 3">Sesi 3 (14:00 -> 16:00)</option>
                  <option value="Sesi 4">Sesi 4 (16:00 -> 19:00)</option>
                  <option value="Sesi 5">Sesi 5 (19:00 -> 22:00)</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="insertSchedule" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel3">Jadwal tanggal : <span id="selectedScheduleDate"></span></h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form method="POST"  id="insertScheduleForm">
              {{ csrf_field() }}
             
              <input type="hidden" name="date" data-date="dateInput">
            <div class="row">
              <div class="col mb-3">
                <label for="daytime" class="form-label">Waktu</label>
                <select  class="form-select" id="daytime" name="daytime">
                  <option value="Sesi 1">Sesi 1 (08:00 -> 11:00)</option>
                  <option value="Sesi 2">Sesi 2 (11:00 -> 16:00)</option>
                  <option value="Sesi 3">Sesi 3 (14:00 -> 16:00)</option>
                  <option value="Sesi 4">Sesi 4 (16:00 -> 19:00)</option>
                  <option value="Sesi 5">Sesi 5 (19:00 -> 22:00)</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label for="user_id" class="form-label">Karyawan</label>
                        <select class="form-select" name="user_id" id="user_id" style="width: 100%">
                        </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
        </div>
      </div>
    </div>

    {{-- <h5 class="card-header">Data Tarif</h5>
    <div class="col-md-8" style="padding-left: 2rem; padding-bottom: 2rem">
      <button class="btn btn-info" data-bs-toggle="modal"
      data-bs-target="#addTransaction">
        Tambah Data
      </button>
    </div> --}}

    <div style="padding: 2rem 2rem 2rem 2rem; width: 100%">
      <div data-language="en" id="date"></div>      
    </div>
  </div>
<br>
  <div class="card" style="padding-top: 1rem">
    <h5 class="card-header">
      Detail Keuntungan
    </h5>
    <div style="padding-left: 2rem; padding-right: 2rem; padding-bottom: 2rem; width: 100%;">
      <div class="table-responsive text-nowrap">
        <table class="table" id="profitTable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tanggal</th>
              <th>Total</th>
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
                <th colspan="1">Total:</th>
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
  <br>

  <div class="card" style="padding-top: 1rem">
    <h5 class="card-header">
      Daftar Karyawan 
    </h5>
    <div style="padding-left: 2rem; padding-right: 2rem; padding-bottom: 2rem; width: 100%;">
      {{-- <div id="alertEmpty">
        <div class="alert alert-primary" role="alert">This is a primary alert — check it out!</div>
      </div> --}}
      <div class="col-md-5" style=" padding-bottom: 2rem;">
        <button class="btn btn-info"class="btn btn-info" data-bs-toggle="modal"
        data-bs-target="#insertSchedule">Tambah Jadwal </button>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table" id="totalFee">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tanggal</th>
              <th>Nama</th>
              <th>Waktu</th>
              <th>Total Fee</th>
            </tr>
          </thead>
          <tbody>
            
          </tbody>
          <tfoot>
            <tr>
                <th colspan="1">Total:</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
        </table>
      </div>
      <div class="col-md-5" style=" padding-top: 2rem;" id="">
        <form method="POST" id="countFee">
          {{ csrf_field() }}
          <input type="hidden" name="date" data-date="dateInput">
          <button class="btn btn-primary" type="submit" id="btnTotalFee">Total Semua Fee </button>
        </form>
        
      </div>
    </div>
  </div>
 
  @endsection