<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Instagram')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{url('/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{url('/plugins/datatables/dataTables.bootstrap.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{url('/dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" href="{{url('dist/css/skins/skin-blue.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="{{url('/css/main.css')}}" rel="stylesheet">
    <link href="{{url('/bootstrap-table/bootstrap-table.css')}}" rel="stylesheet">
    <link href="{{url('/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{url('/plugins/lobibox/css/lobibox.min.css')}}" rel="stylesheet">
    <link href="{{url('/plugins/lobibox/css/animate.css')}}" rel="stylesheet">
    <link href="{{url('/plugins/iCheck/all.css')}}" rel="stylesheet">
    <link href="{{url('/dist/css/loaders.css')}}" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <a href="{{URL::route('dashboard')}}" class="logo">
            <span class="logo-mini"><b>I</b>M</span>
            <span class="logo-lg"><b>Intellij</b>Marketing</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                        {{--<li>--}}
                            {{--<a id="userBalance" data-url="{{URL::route('api.get_balance', Auth::user()->token)}}"--}}
                               {{--href="{{URL::route('billing.index')}}">--}}
                                {{--@include('cabinet.common.balance')--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
{{--                                <img src="{{ \App\Models\User::getAvatarUrl() }}" class="user-image" alt="">--}}
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
{{--                                    <img src="{{ \App\Models\User::getAvatarUrl() }}" class="img-circle" alt="">--}}
                                    <p>{{ Auth::user()->name }}</p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="home" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{URL::to('/logout')}}" class="btn btn-default btn-flat">Sign
                                            out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

    </header>

    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">

                <li class="{{(Request::is("dashboard")) ? 'active' : ''}}">
                    <a href="{{URL::route('dashboard')}}"> <i class="fa fa-dashboard"></i> Dashboard </a>
                </li>

                <li class="treeview {{(Request::is('my/facebook*')) ? 'active' : ''}}">
                    <a href="#">
                        <i class="fa fa-instagram"></i> <span>Instagram</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{(Request::is("dashboard/instagram")) ? 'active' : ''}}">
                            <a href="{{URL::route('instagram.index')}}"> <i class="fa fa-users"></i> Accounts </a>
                        </li>
                    </ul>
                </li>

                <li class="{{(Request::is("dashboard")) ? 'active' : ''}}">
                    <a href="{{URL::route('dashboard')}}"> <i class="fa fa-money"></i> Billing </a>
                </li>

            </ul>
        </section>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
        <div class="clearfix"></div>
    </div>
    <!-- /.content-wrapper -->


    <footer class="main-footer no-print">
        &copy; {{ date('Y') }} Intellij Marketing
    </footer>

</div>

<script src="{{url('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>

<script src="{{url('bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{url('plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{url('bootstrap-table/bootstrap-table.js')}}"></script>
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{url('plugins/lobibox/js/lobibox.min.js')}}"></script>
<script src="{{url('plugins/lobibox/js/notifications.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{url('dist/js/app.min.js')}}"></script>
<script src="{{url('app.min.js')}}"></script>

@yield('js')
</body>
</html>