@extends('layouts.app')

@section('title')
    Currency
@endsection

@push('css')
    @include('includes.styles.datatable')
    @include('includes.styles.basic')
    <style type="text/css">
        .alert, .alert-danger{
            z-index:1052 !important;
        }
    </style>
@endpush

@section('breadcrumb')
<h1 class="flex-grow-1 fs-3 fw-bold my-2 my-sm-3">Currency</h1>
<nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Essentails</li>
        <li class="breadcrumb-item active" aria-current="page">Currency</li>
    </ol>
</nav>
@endsection


@section('content')
<div class="block block-rounded">
    <div class="block-header border-bottom border-2">
        <h3 class="mb-0 py-1 fs-4 fw-bold">Filter Option</h3>
    </div>
    <div class="block-content block-content-full">
        <!-- Form Grid with Labels -->
        <form action=""  method="GET">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label">Currency Name/Code</label>
                    <input type="text" class="form-control" value="{{request('name_or_code')}}" id="filter_name_or_code" name="name_or_code">
                </div>
               

                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label">Status</label>
                    <select class="form-control" id="filter_status" name="status">
                        <option disabled selected>Choice Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>        
                
            </div>
            <button type="submit" class="btn btn-sm btn-primary" id="filter-button">Filter</button>
            <a href="" class="btn btn-sm btn-secondary">Reset</a>

        </form>
        <!-- END Form Grid with Labels -->
    </div>
</div>

<!-- Dynamic Table with Export Buttons -->
<div class="block block-rounded">
    <div class="block-header border-bottom border-2">
        <h3 class="mb-0 py-1 fs-4 fw-bold">Currency List</h3>
        <button  class="btn btn-sm btn-outline-primary show-modal" data-url="{{ route('currency.create') }}">Create New Currency</button>

    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
        <table id="example" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%;">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" /></th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Symbol</th>
                    <th>Conv. Rate</th>
                    <th>Status</th>
                    <th>Last Modify</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Symbol</th>
                    <th>Conv. Rate</th>
                    <th>Status</th>
                    <th>Last Modify</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- END Dynamic Table with Export Buttons -->


@endsection


@push('js')
    @include('includes.scripts.datatable')
    @include('includes.scripts.basic')
@endpush

@push('scripts')
<script>

       
        var table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            "paging": true,
            "deferRender": true,
            pageLength: 10,
            order: [
                [6, "desc"]
            ],
            dom: "<'row'<'col-sm-12 text-center py-2'<'text-center mb-2'B>>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            ajax: {
                url: @json(route('currency.index')),
                data: function (d) {
                        d.name_or_code = $('#filter_name_or_code').val()
                        d.status = $('#filter_status').val()
                    }
            },
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'symbol',
                    name: 'symbol'
                },
                {
                    data: 'conversion_rate',
                    name: 'conversion_rate'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                
                {
                    data: 'updated_at',
                    name: 'updated_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ],
            buttons: [
            {
                extend:'print',
                className: 'btn btn-sm',
                key: {
                        cltrKey: true,
                        key: 'p'
                    }
            },
            {
                extend:'excel',
                className: 'btn btn-sm',
                key: {
                    cltrKey: true,
                    key: 'e'
                }
            },
            {
                extend:'copy',
                className: 'btn btn-sm',
                key: {
                    cltrKey: true,
                    key: 'c'
                }
            },
            {
                extend:'csv',
                className: 'btn btn-sm',
                key: {
                    cltrKey: true,
                    shiftKey: true,
                    key: 'c'
                }
            },
            {
                extend:'pdf',
                className: 'btn btn-sm',
                key: {
                    cltrKey: true,
                    shiftKey: true,
                    key: 'p'
                }
            },
            {
                extend:'colvis',
                columns: ':not(:nth-child(-n+1))',
                className: 'btn btn-sm'
            },
            {
                text: 'Delete Selected',
                className: 'btn btn-sm delete-selected bg-danger text-white',
                attr:  {
                    url: @json(route('currency.multi_delete'))
                }
            }
            ],
        });

        $('#filter-button').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            table.draw();
            

        });

        $('.dt-buttons').children().removeClass('btn-secondary').addClass('btn-outline-primary')

        $('.buttons-colvis').removeClass('btn-secondary').addClass('btn-outline-primary');
        $('.buttons-colvis').parent().removeClass('btn-outline-primary').addClass('border-0');  

        var select_all = document.getElementById('selectAll');
        var checkboxs = document.getElementsByClassName('checkbox');

        select_all.addEventListener('change', function () {
            for (var i = 0; i < checkboxs.length; i++) {
                checkboxs[i].checked = select_all.checked;
            }
        });

        for (var i = 0; i < checkboxs.length; i++) {
            checkboxs[i].addEventListener('change', function () {
                if (this.checked == false) {
                    select_all.checked = false;
                }

                if (document.querySelectorAll('.checkbox:checked').length == checkboxs.length) {
                    select_all.checked = true;
                }

            });
        }
</script>
@endpush   