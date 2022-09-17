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
       <table class="table table-sm table-bordered" style="width: 100%" id="s_type_table">
            <thead>
                <tr>
                    <th>#</th>
                    
                    <th>{{__('lb.supplier_type')}}</th>
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
         
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // get unit
    var table = $('#s_type_table').DataTable({
        responsive: true,
        autoWidth: false,
        ajax: {
            url: "{{ route('supplier-type.index') }}",
            type: 'GET'
        },
        columns: [
            {
                data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false
            },
            {
                data: 's_type',
                name: 's_type'
            },
           
            {
                data: 'note',
                name: 'note'
            },
        
            {
                data: 'username',
                name: 'username'
            },
          
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
    })

</script>
@endsection