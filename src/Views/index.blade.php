
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="access-token" content="{{session()->get('accessToken')}}">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendor/whtht/intro-step/assets/css/font-awesome.min.css')}}">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{asset('vendor/whtht/intro-step/assets/css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/whtht/intro-step/vue/app/index.css')}}">
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{config('app.name')}}</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">

        </li>
    </ul>
</nav>

<div class="container-fluid" id="app">
    <sidebar></sidebar>
    <div class="row">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">@{{title}}</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <router-link to="/steps/create" tag="button" class="btn btn-sm btn-success">New Step</router-link>
                        <button class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                </div>
            </div>
            <breadcrumb></breadcrumb>
            <router-view class="mb-5"></router-view>
        </main>
    </div>
</div>




<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>


<script src="{{asset('vendor/whtht/intro-step/vue/app/index.js')}}"></script>

{{--<script>--}}
    {{--var ctx = document.getElementById("myChart");--}}
    {{--var myChart = new Chart(ctx, {--}}
        {{--type: 'line',--}}
        {{--data: {--}}
            {{--labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],--}}
            {{--datasets: [{--}}
                {{--data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],--}}
                {{--lineTension: 0,--}}
                {{--backgroundColor: 'transparent',--}}
                {{--borderColor: '#007bff',--}}
                {{--borderWidth: 4,--}}
                {{--pointBackgroundColor: '#007bff'--}}
            {{--}]--}}
        {{--},--}}
        {{--options: {--}}
            {{--scales: {--}}
                {{--yAxes: [{--}}
                    {{--ticks: {--}}
                        {{--beginAtZero: false--}}
                    {{--}--}}
                {{--}]--}}
            {{--},--}}
            {{--legend: {--}}
                {{--display: false,--}}
            {{--}--}}
        {{--}--}}
    {{--});--}}
{{--</script>--}}
</body>
</html>
