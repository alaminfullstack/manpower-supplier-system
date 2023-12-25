@extends('layouts.app')

@section('title')
    System Setting
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
    <h1 class="flex-grow-1 fs-3 fw-bold my-2 my-sm-3">System Setting</h1>
    <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Settings</li>
            <li class="breadcrumb-item active" aria-current="page">System Setting</li>
        </ol>
    </nav>
@endsection


@section('content')
    <!-- Dynamic Table with Export Buttons -->
    <div class="block block-rounded">
        <div class="block-header border-bottom border-2">
            <h3 class="mb-0 py-1 fs-4 fw-bold">System Setting</h3>
        </div>
        <div class="block-content block-content-full">
            <form action="{{ route('systemsetting.update', $system_setting->id) }}" method="POST" class="submit-form">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        <label class="form-label">System Logo</label>
                        <a class="block block-rounded block-link-pop border" href="javascript:void(0)">

                            <input type="hidden" class="form-control image_input" value="{{ $system_setting->app_image }}"
                                name="app_image" readonly aria-label="Image" aria-describedby="button-image">

                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <img class="image_src img-avatar img-avatar-thumb img-avatar-rounded shadow-sm img-avatar48 button-image"
                                    src="{{ $system_setting->app_image != null ? asset($system_setting->app_image) : asset('storage/default/default_image.png') }}"
                                    alt="">
                                <div class="ms-3 text-end">
                                    <button class="btn btn-secondary image_button" type="button">Select
                                        image</button>
                                </div>
                            </div>
                        </a>


                        <label class="form-label">Favivon Logo</label>
                        <a class="block block-rounded block-link-pop border" href="javascript:void(0)">

                            <input type="hidden" class="form-control image_input"
                                value="{{ $system_setting->favicon_image }}" name="favicon_image" readonly
                                aria-label="Image" aria-describedby="button-image">

                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <img class="image_src img-avatar img-avatar-thumb img-avatar-rounded shadow-sm img-avatar48 button-image"
                                    src="{{ $system_setting->favicon_image != null ? asset($system_setting->favicon_image) : asset('storage/default/default_image.png') }}"
                                    alt="">
                                <div class="ms-3 text-end">
                                    <button class="btn btn-secondary image_button" type="button">Select
                                        image</button>
                                </div>
                            </div>
                        </a>

                        <label class="form-label">Invoice Logo</label>
                        <a class="block block-rounded block-link-pop border" href="javascript:void(0)">

                            <input type="hidden" class="form-control image_input"
                                value="{{ $system_setting->invoice_image }}" name="invoice_image" readonly
                                aria-label="Image" aria-describedby="button-image">

                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <img class="image_src img-avatar img-avatar-thumb img-avatar-rounded shadow-sm img-avatar48 button-image"
                                    src="{{ $system_setting->invoice_image != null ? asset($system_setting->invoice_image) : asset('storage/default/default_image.png') }}"
                                    alt="">
                                <div class="ms-3 text-end">
                                    <button class="btn btn-secondary image_button" type="button">Select
                                        image</button>
                                </div>
                            </div>
                        </a>


                        <label class="form-label">Default Logo</label>
                        <a class="block block-rounded block-link-pop border" href="javascript:void(0)">

                            <input type="hidden" class="form-control image_input"
                                value="{{ $system_setting->default_image }}" name="default_image" readonly
                                aria-label="Image" aria-describedby="button-image">

                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <img class="image_src img-avatar img-avatar-thumb img-avatar-rounded shadow-sm img-avatar48 button-image"
                                    src="{{ $system_setting->default_image != null ? asset($system_setting->default_image) : asset('storage/default/default_image.png') }}"
                                    alt="">
                                <div class="ms-3 text-end">
                                    <button class="btn btn-secondary image_button" type="button">Select
                                        image</button>
                                </div>
                            </div>
                        </a>

                        <label class="form-label">Customer Default Logo</label>
                        <a class="block block-rounded block-link-pop border" href="javascript:void(0)">

                            <input type="hidden" class="form-control image_input"
                                value="{{ $system_setting->default_image }}" name="customer_default_image" readonly
                                aria-label="Image" aria-describedby="button-image">

                            <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <img class="image_src img-avatar img-avatar-thumb img-avatar-rounded shadow-sm img-avatar48 button-image"
                                    src="{{ $system_setting->default_image != null ? asset($system_setting->default_image) : asset('storage/default/default_image.png') }}"
                                    alt="">
                                <div class="ms-3 text-end">
                                    <button class="btn btn-secondary image_button" type="button">Select
                                        image</button>
                                </div>
                            </div>
                        </a>


                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Company title</label>
                                <input type="text" id="english" class="form-control" name="app_title"
                                    value="{{ $system_setting->app_title }}">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Company Arabic</label>
                                <input type="text" id="arabic" class="form-control" name="app_title_arabic"
                                    value="{{ $system_setting->app_title_arabic }}">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Company Phone</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ $system_setting->phone }}">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Company Email</label>
                                <input type="text" class="form-control" name="email"
                                    value="{{ $system_setting->email }}">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Company Address</label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ $system_setting->address }}">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Vat Number</label>
                                <input type="text" class="form-control" name="vat_number"
                                    value="{{ $system_setting->vat_number }}">
                            </div>
                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Default Vat</label>
                                <input type="number" class="form-control" name="default_vat"
                                    value="{{ $system_setting->default_vat }}">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Default Currency</label>
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Choose one.." name="default_currency" id="default_currency">
                                    <option disabled selected value="">Select Currency</option>
                                    @foreach ($currencies as $currency)
                                        <option value="{{ $currency->id }}"
                                            @if ($currency->id == $system_setting->default_currency) selected @endif data-code="{{$currency->code}}" data-symbol="{{ $currency->symbol }}">{{ $currency->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Currency Code</label>
                                <input type="text" class="form-control" readonly name="currency_code" id="currency_code"
                                    value="{{ $system_setting->currency_code }}">
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Currency Symbol</label>
                                <input type="text" class="form-control" readonly name="currency_symbol" id="currency_symbol"
                                    value="{{ $system_setting->currency_symbol }}">
                            </div>


                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Currency Position</label>
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Choose one.." name="currency_position">
                                    <option disabled selected value="">Select Currency Position</option>
                                    @foreach ($currency_positions as $currency_position)
                                        <option value="{{ $currency_position }}"
                                            @if ($currency_position == $system_setting->currency_position) selected @endif>{{ $currency_position }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Date Format</label>
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Choose one.." name="date_format">
                                    <option disabled selected value="">Select Date Format</option>
                                    @foreach ($date_formats as $date_form => $date_format)
                                        <option value="{{ $date_form }}"
                                            @if ($date_form == $system_setting->date_format) selected @endif>{{ $date_format }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Date Time Format</label>
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Choose one.." name="date_time_format">
                                    <option disabled selected value="">Select Date Time Format</option>
                                    @foreach ($date_formats as $date_form => $date_format)
                                        <option value="{{ $date_form }}"
                                            @if ($date_form == $system_setting->date_time_format) selected @endif>{{ $date_format }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Default Time Zone</label>
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Choose one.." name="default_time_zone">
                                    <option disabled selected value="">Select Timezone</option>
                                    @foreach ($timezones as $time_zone => $timezone)
                                        <option value="{{ $timezone }}"
                                            @if ($timezone == $system_setting->default_time_zone) selected @endif>{{ $time_zone }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Decimal Number Limit</label>
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Choose one.." name="decimal_number_limit">
                                    @foreach ($decimal_number_limits as $decimal_number_limit)
                                        <option value="{{ $decimal_number_limit }}"
                                            @if ($decimal_number_limit == $system_setting->decimal_number_limit) selected @endif>{{ $decimal_number_limit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-4">
                                <label class="form-label">Enabled Dark mode</label>
                                <select class="js-select2 form-select" style="width: 100%;"
                                    data-placeholder="Choose one.." name="enabled_dark_mode">
                                    <option value="1" @if ($system_setting->enabled_dark_mode == 1) selected @endif>Yes</option>
                                    <option value="0" @if ($system_setting->enabled_dark_mode == 0) selected @endif>No</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-outline-primary mb-3">
                                    Save System Setting
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
       $(document).on('change', '#default_currency', function(){
          let code = $(this).find(':selected').data('code');
          let symbol = $(this).find(':selected').data('symbol');
          console.log(code)
          console.log(symbol)

          $('#currency_code').val(code)
          $('#currency_symbol').val(symbol)
       })
    </script>
@endpush
