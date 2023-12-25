<div class="modal-dialog modal-lg modal-dialog-popout" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Create New Currency</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <!-- Form Grid with Labels -->
                <form method="POST" class="submit-form" action="{{ route('currency.store') }}">
                  @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Code</label>
                            <input type="text" class="form-control" name="code">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Symbol</label>
                            <input type="text" class="form-control" name="symbol">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Conversion Rate</label>
                            <input type="number" step="0.1" class="form-control" name="conversion_rate">
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
