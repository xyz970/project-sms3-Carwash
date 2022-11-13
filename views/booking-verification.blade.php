<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">     --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />

    <title>Verifikasi Reservasi</title>
</head>

<body>
    <div style="width:800px; margin:0 auto; padding-top: 2rem;">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h3>Verifikasi</h3>
                    <div class="col-md-12" id="showAlert">

                    </div>
                    <form id="verifikasi">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col mb-3">
                                <input type="text" required id="name" placeholder="Atas Nama" name="name"
                                    class="form-control" />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">Verifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/js/config.js')}}"></script>
<script>
    $('#verifikasi').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('booking.verification_check') }}",
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                // console.log(data);
                swal("Success", "Data reservasi berhasil divalidasi", "success");
                $('#verifikasi').remove()
                // $("#btn-save").html('Submit');
                // $("#btn-save"). attr("disabled", false);
            },
            error: function(data) {
                // console.log(data.responseJSON.message);
                $('#showAlert').append(` <div class="alert alert-danger alert-dismissible fade show" role="alert">
                `+data.responseJSON.message+`
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>`)
            }
        })
    })
</script>

</html>
