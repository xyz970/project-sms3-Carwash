@extends('admin.layouts.main',['title'=>'Data Karyawan','breadcumb'=>'Data Karyawan'])
@section('content')
  <div class="card">
    
    <!-- Large Modal -->
    <div class="modal fade" id="addEmployee" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel3">Tambah Karyawan</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form method="POST"  id="addEmployeeForm">
              {{ csrf_field() }}
              <div class="row">
                <div class="col mb-3">
                  <label for="name" class="form-label">Nama</label>
                  <input type="text" id="name" name="name" class="form-control"/>
                </div>
              </div>
              <div class="row">
                <div class="col mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" id="email" name="email" class="form-control"/>
                </div>
              </div>
            {{-- <div class="row">
              <div class="col mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" id="price" name="price" class="form-control"/>
              </div>
            </div> --}}
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

    <h5 class="card-header">Data Karyawan</h5>
    <div class="col-md-8" style="padding-left: 2rem; padding-bottom: 2rem">
      <button class="btn btn-info" data-bs-toggle="modal"
      data-bs-target="#addEmployee">
        Tambah Data
      </button>
    </div>

    <div style="padding-left: 2rem; padding-right: 2rem; padding-bottom: 2rem; width: 100%">
        <div class="table-responsive text-nowrap">
            <table class="table" id="EmployeeTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Password</th>
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