@extends('layouts.master')
@section('title')
    {{__('lb.items')}}
@endsection
@section('header')
    {{__('lb.items')}}
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('chosen/chosen.min.css')}}">
<div class="toolbox pt-1 pb-1">

    <div class="row">
    <div class="col-md-2">
    @cancreate('item')
    <button class="btn btn-success btn-sm" data-toggle='modal' data-target='#createModal' id='btnCreate'>
        <i class="fa fa-plus-circle"></i> {{__('lb.create')}}
    </button>
    @endcancreate
</div>


</form>
</div>  
</div>   
<div class="card">
	
	<div class="card-body">
       @component('coms.alert')
       @endcomponent
       <table class="table table-sm table-bordered" style="width: 100%" id="type_table">
            <thead>
                <tr>
                    <th>#</th>
                    
                    <th>{{__('lb.customer type')}}</th>
                    <th>{{__('lb.note')}}</th>
                    <th>{{__('lb.user')}}</th>
                    <th>{{ __('lb.action') }}</th>
                </tr>
            </thead>
        
        </table>
	</div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $("#menu_customer").addClass('menu-open');
        $("#sub_customer").addClass('active');
        $("#type_customer").addClass('myactive');
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

        var table = $('#type_table').DataTable({
            pageLength: 50,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: {
                url: "{{ route('cusomer_type.index') }}",
                type: 'GET'
            },
            columns: [
           
                {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
               
                {data: 'c_type', name: 'c_type'},
                {data: 'note', name: 'note'},
                {data: 'username', name: 'users.username'},
               
                {
                    data: 'action', 
                    name: 'action', 
                    orderable: false, 
                    searchable: false
                },
            ],
            "initComplete" : function () {
            $('.dataTables_scrollBody thead tr').addClass('hidden');
        }
                    
                });
    });
    // function edit(id, obj)
    // {
    //     $('#esms').html('');
    //     let tbl = $(obj).attr('table');
    //     $.ajax({
    //         type: 'GET',
    //         url: burl + '/bulk/get/' + id + '?tbl=' + tbl,
    //         success: function(sms)
    //         {
    //             let data = JSON.parse(sms);
    //             $('#eid').val(data.id);
    //             $('#ename').val(data.name);
    //         }
    //     });
    // }
</script>
@endsection