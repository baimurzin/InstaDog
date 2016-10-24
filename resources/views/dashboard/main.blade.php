@extends('dashboard.layout')

@section('style')

@stop

@section('content')
<div class="col-md-12 col-lg-7">
    <div class="row">
        {{--balance--}}
        <div class="col-md-3">
            <a href="go.com">
                <div class="panel widget-mini">
                    <div class="panel-body">
                        <i class="fa fa-credit-card-alt"></i>
                        <span class="total text-center">$0</span>
                        <span class="title text-center">Balance</span>
                    </div>
                </div>
            </a>
        </div>

        {{--tarif plan--}}

        <div class="col-md-6">
            <a href="site.com">
                <div class="panel widget-mini">
                    <div class="panel-body">
                        <i class="fa fa-bar-chart"></i>
                        <span class="total text-center">Trial</span>
                        <span class="title text-center">Тарифный план</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="go.com">
                <div class="panel widget-mini">
                    <div class="panel-body">
                        <i class="fa fa-credit-card-alt"></i>
                        <span class="total text-center">$0</span>
                        <span class="title text-center">Balance</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <div class="panel widget-mini">
                <div class="panel-body">
                    <i class="icon-rocket"></i>
                    <span class="total text-center">1</span>
                    <span class="title text-center">Работающая задача</span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel widget-mini">
                <div class="panel-body">
                    <i class="icon-users"></i>
                    <span class="total text-center">2</span>
                    <span class="title text-center">Добавлено аккаунта</span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel box-danger widget-mini">
                <div class="panel-body">
                    <i class="icon-info"></i>
                    <span class="total text-center">Внимание!</span>
                    <span class="title text-center">Вы не добавили в систему собственные прокси! Сделать это можно <a href="http://new.socialhammer.com/setting/proxy">здесь</a>.</span></div>
            </div>
        </div>


    </div>
</div>
@stop

@section('js')

@stop
