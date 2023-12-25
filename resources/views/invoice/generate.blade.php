@extends('layouts.app')

@section('title')
    Generated Invoice
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
    <h1 class="flex-grow-1 fs-3 fw-bold my-2 my-sm-3">Generated Invoice</h1>
    <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Invoice</li>
            <li class="breadcrumb-item active" aria-current="page">Generated Invoice</li>
        </ol>
    </nav>
@endsection


@section('content')
    <!-- Dynamic Table with Export Buttons -->
    <div class="block block-rounded">
        <div class="block-header border-bottom border-2">
            <h3 class="mb-0 py-1 fs-4 fw-bold">Generated Invoice</h3>
        </div>
        <div class="block-content block-content-full">
            <form method="POST" action="{{ route('invoice.store') }}">
                @csrf
                <div class="row push">
                    <div class="col-lg-12">
                      <div class="row items-push">
                        <div class="col-md-6">
                          <div class="form-check form-block">
                            <input class="form-check-input" type="checkbox" readonly value="" checked id="example-checkbox-block1" name="example-checkbox-block1">
                            <label class="form-check-label" for="example-checkbox-block1">
                              <span class="d-flex align-items-center">
                                <img class="img-avatar img-avatar48 shadow" src="{{ get_system_setting()->app_image != null ? asset(get_system_setting()->app_image) : asset('storage/default/default_image.png') }}" alt="">
                                <span class="ms-4">
                                  <span class="fw-bold">{{ get_system_setting()->app_title }}</span>
                                  <br/>
                                  <span class="fw-bold">{{ get_system_setting()->app_title_arabic }}</span>
                                  <span class="d-block fs-sm text-muted">{{ get_system_setting()->address }}</span>
                                  <span class="d-block fs-sm text-muted">{{ get_system_setting()->vat_number }}</span>
                                </span>
                              </span>
                            </label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-check form-block">
                            <input class="form-check-input" readonly type="checkbox" value="{{$customer->id}}" id="example-checkbox-block2" name="customer_id" checked>
                            <label class="form-check-label" for="example-checkbox-block2">
                              <span class="d-flex align-items-center">
                                <img class="img-avatar img-avatar48" src="{{ $customer->image != null ? asset($customer->image) : asset('storage/default/default_image.png') }}" alt="">
                                <span class="ms-4">
                                  <span class="fw-bold">{{ $customer->name }}</span>
                                  <span class="fw-bold">{{ $customer->name_arabic }}</span>
                                  <span class="d-block fs-sm text-muted">{{ $customer->address }}</span>
                                  <span class="d-block fs-sm text-muted">{{ $customer->contact_name }}</span>
                                  @if ($customer->name_arabic == null)     
                                  <span class="d-block fs-sm text-muted">{{ $customer->phone }}</span>
                                  @endif
                                </span>
                              </span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                <div class="row">

                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Invoice Date</label>
                                <input type="datetime-local" class="form-control" name="invoice_date"
                                    value="{{ now()->format('Y-m-d\TH:i:s') }}">
                            </div>

                            <div class="col-12 col-md-6  col-lg-4 mb-4">
                                <label class="form-label">Invoice No</label>
                                <input type="text" class="form-control" name="invoice_number"
                                   />
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Due Date</label>
                                <input type="date" class="form-control" name="due_date"
                                    value="">
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Our Vat No</label>
                                <input type="text" class="form-control" name="vat_number"
                                    value="{{ get_system_setting()->vat_number }}">
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Credit Days</label>
                                <input type="text" class="form-control" name="credit_days"
                                    />
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Payment Mode</label>
                                <input type="text" class="form-control" name="payment_mode"
                                    />
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Reference No</label>
                                <input type="text" class="form-control" name="reference_number"
                                    >
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">PO Number</label>
                                <input type="text" class="form-control" name="po_number"
                                    >
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Project Number</label>
                                <input type="text" class="form-control" name="project_number"
                                    >
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control" name="subject"
                                    >
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Bank name</label>
                                <input type="text" class="form-control" name="bank_name"
                                    >
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">IBAN</label>
                                <input type="text" class="form-control" name="iban"
                                    />
                            </div>

                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <label class="form-label">Account Number</label>
                                <input type="text" class="form-control" name="account_number"
                                    />
                            </div>
                            <div class="col-12 col-md-6 col-lg-8 mb-4">
                                <label class="form-label">Note</label>
                                <input type="text" class="form-control" name="note"
                                    />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p class="fw-bold">We Are Pleased To Submit Our Monthly Invoice For The Supply Of Manpower For The Month Of {{ $month_name }} {{ now()->format('Y') }}</p>
                        <input type="hidden" value="{{ $month_name }}" name="invoice_month" />
                        <table class="table table-bordered bg-light">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Name</th>
                                    <th>Iqama Id</th>
                                    <th>Designation</th>
                                    <th>Total Hours</th>
                                    <th>Rate/Hour</th>
                                    <th>Total Amount</th>
                                    <th>Vat (%)</th>
                                    <th>Vat Amount</th>
                                    <th>Total with Vat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $final_total_amount = 0;
                                    $final_vat_amount = 0;
                                    $final_grand_amount = 0;
                                @endphp
                                @forelse ($man_power_supplies as $man_power)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                            <input type="hidden" name="serial_number[]" value="{{ $loop->iteration }}"/>
                                        </td>
                                        <td>
                                            {{ $man_power->person->name ?? null }}
                                            <input type="hidden" name="people_id[]" value="{{ $man_power->people_id }}"/>
                                        </td>
                                        <td>
                                            {{ $man_power->iqama_id }}
                                            <input type="hidden" name="iqama_id[]" value="{{ $man_power->iqama_id }}"/>
                                        </td>
                                        <td>
                                            {{ $man_power->designation }}
                                            <input type="hidden" name="designation[]" value="{{ $man_power->designation }}"/>
                                        </td>
                                        <td>
                                            {{ $man_power->total_hours }}
                                            <input type="hidden" name="total_hours[]" value="{{ $man_power->total_hours }}"/>
                                        </td>
                                        <td>
                                            {{ $man_power->rate_hour }}
                                            <input type="hidden" name="rate_hour[]" value="{{ $man_power->rate_hour }}"/>
                                        </td>
                                        <td>
                                            {{ $man_power->total_amount }}
                                            <input type="hidden" name="total_amount[]" value="{{ $man_power->total_amount }}"/>
                                        </td>
                                        <td>
                                            {{ $man_power->vat }}
                                            <input type="hidden" name="vat[]" value="{{ $man_power->vat }}"/>
                                        </td>
                                        <td>
                                            {{ $man_power->vat_amount }}
                                            <input type="hidden" name="vat_amount[]" value="{{ $man_power->vat_amount }}"/>
                                        </td>
                                        <td>
                                            {{ $man_power->grand_amount }}
                                            <input type="hidden" name="grand_amount[]" value="{{ $man_power->grand_amount }}"/>
                                        </td>
                                    </tr>
                                    @php
                                        $final_total_amount += $man_power->total_amount;
                                        $final_vat_amount += $man_power->vat_amount;
                                        $final_grand_amount += $man_power->grand_amount;
                                    @endphp
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            <p>Date Not Found</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">
                                        
                                    </th>
                                    <th colspan="2">Total</th>
                                    <th>
                                        {{$final_total_amount}}
                                        <input type="hidden" name="final_total_amount" value="{{ $final_total_amount }}"/>
                                    </th>
                                    <th colspan="2" class="text-end">
                                        {{$final_vat_amount}}
                                        <input type="hidden" name="final_vat_amount" value="{{ $final_vat_amount }}"/>
                                    </th>
                                    <th>
                                        {{ $final_grand_amount }}
                                        <input type="hidden" name="final_grand_amount" value="{{ $final_grand_amount }}"/>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-lg btn-primary mb-3" name="final" value="1">
                            Final Now
                        </button>

                        <button type="submit" class="btn btn-lg btn-secondary mb-3" name="draft"  value="0">
                            Draft Now
                        </button>
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
    <script></script>
@endpush
