@extends('layouts.app')

@section('title')
    Man Power Supply
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
<h1 class="flex-grow-1 fs-3 fw-bold my-2 my-sm-3">Man Power Supply</h1>
<nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Essentails</li>
        <li class="breadcrumb-item active" aria-current="page">Man Power Supply</li>
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
                    <label class="form-label">Customer Name</label>
                    <select class="js-select2 form-select"  style="width: 100%;" data-placeholder="Choose one.." id="customer" name="customer_id">
                        <option disabled selected value="">Select Customer</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }} --
                                {{ $customer->name_arabic }}</option>
                        @endforeach
                    </select>
                </div>
               

                <div class="col-12 col-md-6 mb-4">
                    <label class="form-label">Status</label>
                    <select class="form-control" id="filter_status" name="status">
                        <option disabled selected value="">Choice Status</option>
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
        <h3 class="mb-0 py-1 fs-4 fw-bold">Man Power Supply List</h3>
        <button  class="btn btn-sm btn-outline-info show-modal" data-url="{{ route('man-power-supply.import') }}">Import New Man Supply</button>
        <button  class="btn btn-sm btn-outline-primary show-modal" data-url="{{ route('man-power-supply.create') }}">Create New Man Supply</button>

    </div>
    <div class="block-content block-content-full">
        <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
        <table id="example" class="table table-striped table-hover table-bordered dt-responsive nowrap" style="width:100%;">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" /></th>
                    <th>Supply Date</th>
                    <th>Customer</th>
                    <th>Person</th>
                    <th>Iqama Id</th>
                    <th>Designation</th>
                    <th>Total Hours</th>
                    <th>Rate/Hour</th>
                    <th>Total</th>
                    <th>Vat</th>
                    <th>Vat Total</th>
                    <th>Grand Total</th>
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
                    <th>Supply Date</th>
                    <th>Customer</th>
                    <th>Person</th>
                    <th>Iqama Id</th>
                    <th>Designation</th>
                    <th>Total Hours</th>
                    <th>Rate/Hour</th>
                    <th>Total</th>
                    <th>Vat</th>
                    <th>Vat Total</th>
                    <th>Grand Total</th>
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
                url: @json(route('man-power-supply.index')),
                data: function (d) {
                        d.customer = $('#customer').val()
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
                    data: 'supply_date',
                    name: 'supply_date'
                },
                {
                    data: 'customer',
                    name: 'customer.name'
                },
                {
                    data: 'person',
                    name: 'person.name'
                },
                {
                    data: 'iqama_id',
                    name: 'iqama_id'
                },
                {
                    data: 'designation',
                    name: 'designation'
                },
                {
                    data: 'total_hours',
                    name: 'total_hours'
                },
                {
                    data: 'rate_hour',
                    name: 'rate_hour'
                },
                {
                    data: 'total_amount',
                    name: 'total_amount'
                },
                {
                    data: 'vat',
                    name: 'vat'
                },
                {
                    data: 'vat_amount',
                    name: 'vat_amount'
                },
                {
                    data: 'grand_amount',
                    name: 'grand_amount'
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
                    url: @json(route('man-power-supply.multi_delete'))
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

        $(document).on('change', '#people_id', function(){
            let designation = $(this).find(':selected').data('designation');
            $('#designation').val(designation);
            $('#iqama_id').val($(this).val());
        });

        $(document).on('change', '#total_hours', function(){
            let total_hours = $(this).val();
            let rate_hour = $('#rate_hour').val();
            get_total_amount(total_hours,rate_hour);
        });

        $(document).on('change', '#rate_hour', function(){
            let total_hours = $('#total_hours').val();
            let rate_hour = $(this).val();
            get_total_amount(total_hours,rate_hour);
        });

        $(document).on('change', '#vat', function(){
            let vat = $(this).val();
            let total_amount = $('#total_amount').val();
            get_vat_amount(total_amount,vat);
        });

        function get_total_amount(total_hours,rate_hour){
            let total_amount = Number(total_hours) * Number(rate_hour);
            $('#total_amount').val(total_amount);
            let vat = $('#vat').val();
            get_vat_amount(total_amount,vat);
        }

        function get_vat_amount(total_amount,vat){
            let vat_amount = Number(total_amount) * Number(vat) / 100;
            $('#vat_amount').val(vat_amount);
            get_grand_amount(total_amount,vat_amount);
        }

        function get_grand_amount(total_amount,vat_amount){
            let grand_amount = Number(total_amount) + Number(vat_amount);
            $('#grand_amount').val(grand_amount);
        }


</script>
@endpush   