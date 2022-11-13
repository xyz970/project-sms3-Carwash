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

    <title>Reservasi Success</title>
</head>

<body>
    <div style="width:800px; margin:0 auto; padding-top: 2rem;">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h3>Countdown Antrian</h3>
                    <h2 id="antrian">0</h2>
                    <a href="{{route('booking.verification')}}" class="btn btn-success">Verifikasi</a>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script>
    function getParameterByName(name, url = window.location.href) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
</script>
<script>
    // Set the date we're counting down to
    var date = new Date();
    var countDownDate = new Date(new Intl.DateTimeFormat('en-US', {
        month: 'long'
    }).format(date) + ' ' + date.getDate() + ',' + date.getFullYear() + ' ' + getParameterByName('time')).getTime();
    // console.log(new Date(countDownDate).getTime());

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("antrian").innerHTML = hours + "j " +
            minutes + "m " + seconds + "d ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("antrian").innerHTML = "EXPIRED";
        }
    }, 1000);
</script>

</html>
