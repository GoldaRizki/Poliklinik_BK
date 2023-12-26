<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Poliklinik</title>

    <link href="{{url('/assets/css/bootstrap.min.css')}}" rel="stylesheet">

</head>
<body>
    
@include('partials/navbar')


@yield('isi')


<script src="{{ url('/assets/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>