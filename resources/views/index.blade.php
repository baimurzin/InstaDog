<!doctype html>
<html ng-app="app" lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inst</title>

    <link rel="stylesheet" href="{{asset('/vendor/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('/vendor/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
</head>
<body>

<div ui-view></div>

<script src="{{asset('/vendor/js/angular.min.js')}}"></script>
<!-- Satellizer CDN -->
<script src="{{asset('/vendor/js/satellizer.min.js')}}"></script>

<script src="{{asset('/vendor/js/ng/ng-ui-route.min.js')}}"></script>
<script src="{{asset('/vendor/js/jquery.min.js')}}"></script>
<script src="{{asset('/vendor/js/bootstrap.min.js')}}"></script>

{{--app.js--}}
<script src="{{asset('app.js') . '?' . time()}}"></script>
{{--conf.js--}}
<script src="{{asset('/app/conf/run.app.js') . '?' . time()}}"></script>
<script src="{{asset('/app/auth/auth.service.js') . '?' . time()}}"></script>
{{--account module--}}
<script src="{{asset('/app/auth/auth.module.js') . '?' . time()}}"></script>
<script src="{{asset('/app/auth/auth.config.js') . '?' . time()}}"></script>
<script src="{{asset('/app/auth/auth.controller.js') . '?' . time()}}"></script>
<script src="{{asset('/app/account/account.module.js') . '?' . time()}}"></script>
<script src="{{asset('/app/account/account.controller.js') . '?' . time()}}"></script>
<script src="{{asset('/app/account/account.factory.js') . '?' . time()}}"></script>
<script src="{{asset('/app/test/test.js') . '?' . time()}}"></script>

</body>
</html>