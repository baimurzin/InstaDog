@extends('dashboard.layout')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="button" onclick="return popupModule.create('{{URL::route('instagram.accounts.create')}}');" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> Add account</button>
                    <button type="button" onclick="return commonModule.deleteIdsFromTable(IM.Instagram.Accounts.instagram_accounts_table);" class="btn btn-danger"><i class="fa fa-remove"></i> Remove</button>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table data-delete_url="{{URL::route('instagram.accounts.delete', [''])}}" data-url="{{URL::route('instagram.accounts.get')}}" id="instagram_accounts_table"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        (function () {
            IM.Instagram.Accounts.initInstagramAccountsTable();
        })();
    </script>
@stop