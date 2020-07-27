<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i,800" rel="stylesheet">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>

    {{ $title ?? '' }}
    {{config('app.name', 'Laravel') }}
</title>
<link rel="icon" type="image/jpg" href="{{ asset('assets/images/logo/logo_inverse.jpg') }}">

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
 <link rel="stylesheet" href="{{ ('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
