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
<script src="{{asset('app.js')}}"></script>
{{--account module--}}
<script src="{{asset('/app/auth/auth.module.js')}}"></script>
<script src="{{asset('/app/auth/auth.config.js')}}"></script>
<script src="{{asset('/app/auth/auth.controller.js')}}"></script>
<script src="{{asset('/app/account/account.module.js')}}"></script>
<script src="{{asset('/app/account/account.controller.js')}}"></script>
<script src="{{asset('/app/account/account.factory.js')}}"></script>
<script src="{{asset('/app/test/test.js')}}"></script>

</body>
</html>