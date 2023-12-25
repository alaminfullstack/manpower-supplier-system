<div class="modal-dialog modal-lg modal-dialog-popout" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Import Man Supply</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <!-- Form Grid with Labels -->
                <form method="POST" class="submit-form" action="{{ route('man-power-supply.import_store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">

                        <div class="col-12 mb-4">
                            <label class="form-label">Import File</label>
                            <input type="file" class="form-control" name="man_power_files" id="man_power_files">
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
