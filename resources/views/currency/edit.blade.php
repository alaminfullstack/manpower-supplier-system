<div class="modal-dialog modal-lg modal-dialog-popout" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Edit Currency</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <!-- Form Grid with Labels -->
                <form method="POST" class="submit-form" action="{{ route('currency.update',$currency->id) }}">
                  @csrf
                  @method('put')
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $currency->name }}">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Code</label>
                            <input type="text" class="form-control" name="code" value="{{ $currency->code }}">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Symbol</label>
                            <input type="text" class="form-control" name="symbol" value="{{ $currency->symbol }}">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Conversion Rate</label>
                            <input type="number" class="form-control" name="conversion_rate" value="{{ $currency->conversion_rate }}" step="0.1">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" @if($currency->status == 1) selected @endif>Active</option>
                                <option value="0" @if($currency->status == 0) selected @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-primary mb-3">
                        Save Currency
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
