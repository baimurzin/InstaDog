<!doctype html>
<html ng-app="app" lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inst</title>

    <link rel="stylesheet" href="{{asset('/vendor/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('/vendor/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('/vendor/css/modules/vendor.css')}}">

    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.css'
          type='text/css' media='all'/>

</head>
<body ng-controller="AppController as app">

<app-header ng-if="authenticated"></app-header>

<div class="container">
    <div class="row">
        <section id="main-content" class="col-md-12">
            <app-side-bar ng-if="authenticated"></app-side-bar>
            <div ui-view></div>
        </section>
    </div>
</div>


<script src="{{asset('/vendor/js/angular.min.js')}}"></script>

<script src="{{asset('/vendor/js/satellizer.min.js')}}"></script>

<script src="{{asset('/vendor/js/ng/ng-ui-route.min.js')}}"></script>
<script src="{{asset('/vendor/js/jquery.min.js')}}"></script>
<script src="{{asset('/vendor/js/bootstrap.min.js')}}"></script>
<script type='text/javascript'
        src='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.js'></script>
{{--assets--}}
<script src="{{asset('/vendor/js/modules/vendor.js') . '?' . time()}}"></script>

{{--app.js--}}
{{--<script src="{{asset('app.js') . '?' . time()}}"></script>--}}
<script src="{{asset('app.min.js') . '?' . time()}}"></script>
{{--conf.js--}}
{{--<script src="{{asset('/app/conf/run.app.js') . '?' . time()}}"></script>--}}
{{--<script src="{{asset('/app/auth/auth.service.js') . '?' . time()}}"></script>--}}
{{--account module--}}
{{--<script src="{{asset('/app/auth/auth.module.js') . '?' . time()}}"></script>--}}
{{--<script src="{{asset('/app/auth/auth.config.js') . '?' . time()}}"></script>--}}
{{--<script src="{{asset('/app/auth/auth.controller.js') . '?' . time()}}"></script>--}}
{{--<script src="{{asset('/app/auth/signup.controller.js') . '?' . time()}}"></script>--}}
{{--<script src="{{asset('/app/account/account.module.js') . '?' . time()}}"></script>--}}
{{--<script src="{{asset('/app/account/account.controller.js') . '?' . time()}}"></script>--}}
{{--<script src="{{asset('/app/account/account.factory.js') . '?' . time()}}"></script>--}}
{{--<script src="{{asset('/app/test/test.js') . '?' . time()}}"></script>--}}

</body>
</html>