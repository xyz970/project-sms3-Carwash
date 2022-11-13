@extends('admin.layouts.main',['title'=>'Tarif','breadcumb'=>'Tarif'])
@section('content')
  <div class="card">
    
    <!-- Large Modal -->
    <div class="modal fade" id="editTransaction" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel3">Edit Tarif</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form method="POST"  id="rateUpdateForm">
              {{ csrf_field() }}
              <div class="row">
                <div class="col mb-3">
                  <label for="rateName" class="form-label">Keterangan</label>
                  <input type="text" id="rateName" name="rateName" class="form-control" readonly disabled/>
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="priceBefore" class="form-label">Harga Semula</label>
                  <input type="text" id="priceBefore" name="priceBefore" class="form-control" readonly disabled/>
                </div>
              </div>
            <div class="row">
              <div class="col mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" id="price" name="price" class="form-control"/>
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

    <h5 class="card-header">Data Tarif</h5>
    <div style="padding-left: 2rem; padding-right: 2rem; padding-bottom: 2rem; width: 100%">
        <div class="table-responsive text-nowrap">
            <table class="table" id="rateTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Keterangan</th>
                  <th>Jenis Pencucian</th>
                  <th>Harga</th>
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