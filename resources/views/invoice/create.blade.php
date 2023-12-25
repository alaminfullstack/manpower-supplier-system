@extends('layouts.app')

@section('title')
    Generate Invoice
@endsection

@push('css')
    @include('includes.styles.basic')
    <style type="text/css">
        .alert,
        .alert-danger {
            z-index: 1052 !important;
        }
    </style>
@endpush

@section('breadcrumb')
    <h1 class="flex-grow-1 fs-3 fw-bold my-2 my-sm-3">Generate Invoice</h1>
    <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Invoice</li>
            <li class="breadcrumb-item active" aria-current="page">Generate Invoice</li>
        </ol>
    </nav>
@endsection


@section('content')
    <!-- Dynamic Table with Export Buttons -->
    <div class="block block-rounded">
        <div class="block-header border-bottom border-2">
            <h3 class="mb-0 py-1 fs-4 fw-bold">Generate Invoice</h3>
        </div>
        <div class="block-content block-content-full">
            <form method="GET" action="{{ route('invoice.generate') }}">
                <div class="row">
                    
                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Month</label>
                                {{-- <input type="datetime-local" class="form-control" name="supply_date"
                                    value="{{ now()->format('Y-m-d\TH:i:s') }}"> --}}
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Choose one.." name="supply_month">
                                    <option disabled selected value="">Select Month</option>
                                    @foreach ($months as $key => $month)
                                        <option value="{{ $key }}">{{ $month }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Year</label>
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Choose one.." name="year">
                                    <option disabled selected value="">Select Year</option>
                                    @for ($i=2020; $i<2040; $i++)
                                        <option value="{{ $i }}" @if($i == now()->format('Y')) selected @endif>{{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Customer Name</label>
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Choose one.." name="customer_id">
                                    <option disabled selected value="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }} -- {{ $customer->name_arabic }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-outline-primary mb-3">
                                    Generate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Dynamic Table with Export Buttons -->
@endsection


@push('js')
    @include('includes.scripts.basic')
@endpush

@push('scripts')
    <script>
    
    </script>
@endpush
