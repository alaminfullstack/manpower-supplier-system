<div class="modal-dialog modal-lg modal-dialog-popout" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Create New Man Supply</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <!-- Form Grid with Labels -->
                <form method="POST" class="submit-form" action="{{ route('man-power-supply.store') }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Supply Date</label>
                            <input type="datetime-local" class="form-control" name="supply_date" value="{{ now()->format('Y-m-d\TH:i:s') }}">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Customer</label>
                            <select class="js-select2 form-select"  style="width: 100%;" data-container=".view-modal" data-placeholder="Choose one.." name="customer_id">
                                <option disabled selected>Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }} --
                                        {{ $customer->name_arabic }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Person</label>
                            <select class="js-select2 form-select"  style="width: 100%;" data-container=".view-modal" data-placeholder="Choose one.." name="people_id" id="people_id">
                                <option disabled selected>Select Person</option>
                                @foreach ($persons as $person)
                                    <option value="{{ $person->id }}" data-designation="{{ $person->designation->title }}">{{ $person->name }} --
                                        {{ $person->name_arabic }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Iqama Id</label>
                            <input type="text" class="form-control" name="iqama_id" id="iqama_id">
                        </div>


                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Designation</label>
                            <input type="text" class="form-control" name="designation" id="designation">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Total Hours</label>
                            <input type="number" step="0.1" class="form-control" name="total_hours" id="total_hours">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Rate/Hour</label>
                            <input type="number" step="0.1" class="form-control" name="rate_hour" id="rate_hour">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Total</label>
                            <input type="number" step="0.1" readonly class="form-control" name="total_amount" id="total_amount">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Vat</label>
                            <input type="number" step="0.1" value="{{ get_system_setting()->default_vat }}" class="form-control" name="vat" id="vat">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Vat Total</label>
                            <input type="number" step="0.1" readonly class="form-control" name="vat_amount" id="vat_amount">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Grand Total</label>
                            <input type="number" step="0.1" readonly class="form-control" name="grand_amount" id="grand_amount">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary mb-3">
                        Save Man Power
                    </button>

                </form>
                <!-- END Form Grid with Labels -->
            </div>
            <div class="block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
