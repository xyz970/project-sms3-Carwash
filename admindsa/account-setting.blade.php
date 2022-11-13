@extends('admin.layouts.main',['title'=>'Pengaturan Akun','breadcumb'=>'Pengaturan Akun'])
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <!-- Account -->
        <hr class="my-0" />
        <div class="card-body">
            <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                  <h6 class="alert-heading fw-bold mb-1">Ketika anda mengubah password anda, anda harus mengulangi proses login</h6>
                </div>
              </div>
          <form id="formAccountSettings" method="POST" action="{{route('admin.updateSetting')}}">
            {{ csrf_field() }}
            <div class="row">
              <div class="mb-3 col-md-12">
                <label for="name" class="form-label">Nama</label>
                <input
                  class="form-control"
                  type="text"
                  id="name"
                  name="name"
                  value="{{Auth::user()->name}}"
                  readonly
                />
              </div>
              <div class="mb-3 col-md-12">
                <label for="email" class="form-label">Email</label>
                <input
                  type="text"
                  class="form-control"
                  id="email"
                  name="email"
                  value="{{Auth::user()->email}}"
                  readonly
                />
              </div>
              <div class="mb-3 col-md-6">
                <label class="form-label" for="password">Password</label>
                  <input
                    type="text"
                    id="password"
                    name="password"
                    value="************"
                    class="form-control"
                    readonly
                  />
              </div>
              <div class="mb-3 col-md-12">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="passwordSwitch">
                    <label class="form-check-label" for="passwordSwitch">Edit Password</label>
                  </div>
              </div>
            
              
            </div>

            <div class="mt-2">
              <button type="submit" class="btn btn-primary me-2">Save changes</button>
              <button type="reset" class="btn btn-outline-secondary">Cancel</button>
            </div>
          </form>
        </div>
        <!-- /Account -->
      </div>
      
    </div>
  </div>
@endsection