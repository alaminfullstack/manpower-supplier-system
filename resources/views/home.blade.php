@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
<h1 class="flex-grow-1 fs-3 fw-bold my-2 my-sm-3">Dashboard</h1>
<nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
</nav>
@endsection

@section('content')
     <!-- Quick Overview -->
     <div class="row row-deck">
        <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center" href="{{ route('invoice.index') }}">
                <div class="block-content py-5">
                    <div class="font-size-h3 font-w600 text-primary mb-1">{{ get_system_currency_format($total_invoice_amount) }}</div>
                    <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                        Total Invoice Amount
                    </p>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center" href="{{ route('customer.index') }}">
                <div class="block-content py-5">
                    <div class="font-size-h3 font-w600 text-success mb-1">{{ $total_customer }}</div>
                    <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                        Total Customer
                    </p>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center" href="{{ route('person.index') }}">
                <div class="block-content py-5">
                    <div class="font-size-h3 font-w600 mb-1">{{ $total_person }}</div>
                    <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                        Total Person
                    </p>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center" href="{{ route('designation.index') }}">
                <div class="block-content py-5">
                    <div class="font-size-h3 font-w600 mb-1">{{ $total_designation }}</div>
                    <p class="font-w600 font-size-sm text-muted text-uppercase mb-0">
                        Total Designation
                    </p>
                </div>
            </a>
        </div>
    </div>
    <!-- END Quick Overview -->

    <!-- Orders Overview -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Orders Overview</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
            </div>
        </div>
        <div class="block-content block-content-full">
            <!-- Chart.js is initialized in js/pages/be_pages_ecom_dashboard.min.js which was auto compiled from _js/pages/be_pages_ecom_dashboard.js) -->
            <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
            <div style="height: 420px;"><canvas class="js-chartjs-overview"></canvas></div>
        </div>
    </div>
    <!-- END Orders Overview -->

    <!-- Top Products and Latest Orders -->
    <div class="row">
        <div class="col-xl-6">
            <!-- Top Products -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Top Customers</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-borderless table-striped table-vcenter font-size-sm">
                        <tbody>
                            @foreach($top_customers as $customer)
                            <tr>
                                <td class="text-center" style="width: 100px;">
                                    <a class="font-w600" href="/">{{ $customer->man_power_supplies_count }}</a>
                                </td>
                                <td>
                                    <a href="/">{{ $customer->name }} {{ $customer->name_arabic }}</a>
                                </td>
                                <td class="d-none d-sm-table-cell text-right text-nowrap">
                                    <div class="text-warning">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Top Products -->
        </div>
        <div class="col-xl-6">
            <!-- Latest Orders -->
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Latest Man Power Supply</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-borderless table-striped table-vcenter font-size-sm">
                        <tbody>
                            @foreach($latest_man_supplies as $man_power)
                            <tr>
                                <td class="font-w600 text-center" style="width: 100px;">
                                    <a href="/">{{ $man_power->iqama_id }}</a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <a href="/">{{ $man_power->person->name }}</a>
                                </td>
                                <td>
                                    <span class="badge text-success">{{$man_power->status ? 'active' : 'Inactive'}}</span>
                                </td>
                                <td class="font-w600 text-right">{{  get_system_currency_format($man_power->grand_amount) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Latest Orders -->
        </div>
    </div>
    <!-- END Top Products and Latest Orders -->
@endsection

@push('js')
<script src="{{ asset('backend/assets/js/plugins/chart.js/chart.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/be_pages_ecom_dashboard.min.js') }}"></script>
@endpush