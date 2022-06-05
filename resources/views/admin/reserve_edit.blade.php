<html>
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets')}}/admin/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{asset('assets')}}/admin/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{asset('assets')}}/admin/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('assets')}}/admin/demo/demo.css" rel="stylesheet" />

</head>

</html>
<body>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">User: {{$data->title}}</h5>

                </div>
                <div class="card-body">

                    <div style="width:1000px; height: auto;">


                        @include('home.message')
                        <form action="{{route('admin_reserve_update',['id'=>$data->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <table>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class=" text-primary">
                                            <tr><th><b>Id</b></th><td>{{$data->id}}</td></tr>
                                            <tr><th><b>User</b></th><td>{{$data->user->name}}</td></tr>
                                            <tr><th><b>Transfer</b></th><td>{{$data->transfer->title}}</td></tr>
                                            <tr><th><b>Pick Up Time</b></th><td>{{$data->pickupTime}}</td></tr>
                                            <tr><th><b>Flight Time</b></th><td>{{$data->flightTime}}</td></tr>
                                            <tr><th><b>Flight Date</b></th><td>{{$data->flightDate}}</td></tr>
                                            <tr><th><b>From</b></th><td>{{$data->fromlocation}}</td></tr>
                                            <tr><th><b>To</b></th><td>{{$data->tolocation}}</td></tr>
                                            <tr><th><b>Date</b></th><td>{{$data->created_at}}</td></tr>
                                            <tr><th><b>Note</b><textarea rows="9" cols="9" name="note" id="note">{{$data->note}}</textarea></th></tr><br><br>
                                            <tr><th><b>Status</b></th>
                                                <td>
                                                    <select name="status">
                                                        <option selected>{{$data->status}}</option>
                                                        <option>Onaylandı</option>
                                                        <option>Reddedildi</option>
                                                    </select>
                                                </td></tr>
                                            <tr><th><button type="submit" class="btn btn-dark">Rezervasyon Güncelle</button></th></tr>
                                            </thead>


                                        </table>
                                    </div>
                                </div>
                            </table>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
