@extends('admin.layouts.main',['title'=>'Transaksi','breadcumb'=>'Transaksi'])
@section('content')
  <div class="card">
    
    <!-- Large Modal -->
    <div class="modal fade" id="addTransaction" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel3">Tambah Transaksi</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <div class="col-md-12" id="showAlert">
              
            </div>
            <form method="POST"  id="transactionInsertForm">
              {{ csrf_field() }}
            <div class="row">
              <div class="col mb-3">
                <label for="name" class="form-label">Nama Pemilik</label>
                <input type="text" id="name" name="name" class="form-control" />
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label for="wash_type" class="form-label">Tipe Pencucian</label>
                        <select  class="form-select" id="wash_type">
                          <option value=""></option>
                          <option value="Motor">Motor</option>
                          <option value="Mobil">Mobil</option>
                          <option value="Karpet">Karpet</option>
                        </select>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label for="wash_type_id" class="form-label">Detail Pencucian</label>
                        <select class="form-select" name="wash_type_id" id="detailPencucian">
                        </select>
              </div>
            </div>
            
            <div class="row g-2">
              <div class="col mb-0">
                <label for="merk_model" class="form-label">Merk Model</label>
                <input type="text" id="merk_model" name="merk_model" class="form-control" placeholder="cth.Honda Vario" />
              </div>
              <div class="col mb-0">
                <label for="plate_number" class="form-label">Plat Nomor</label>
                <input type="text" id="plate_number" name="plate_number" class="form-control"/>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <label for="total" class="form-label">Harga Total</label>
                <input type="text" id="total" name="total" class="form-control" readonly/>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-primary">Simpan <span id="loading" role="status"></span></button>
          </div>
        </form>
        </div>
      </div>
    </div>

    <h5 class="card-header">Data Transaksi</h5>
    <div class="col-md-5" style="padding-left: 2rem; padding-bottom: 2rem">
      <button class="btn btn-info" data-bs-toggle="modal"
      data-bs-target="#addTransaction">
        Tambah Data
      </button>
    </div>

    <div style="padding-left: 2rem; padding-right: 2rem; padding-bottom: 2rem">
        <div class="table-responsive text-nowrap">
            <table class="table" id="transactionTable">
              <thead>
                <tr>
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