<div class="modal-dialog modal-lg modal-dialog-popout" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Create New Designation</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <!-- Form Grid with Labels -->
                <form method="POST" class="submit-form" action="{{ route('designation.store') }}">
                  @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Title</label>
                            <input type="text" id="english" class="form-control" name="title">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Title Arabic</label>
                            <input type="text" class="form-control" id="arabic" name="title_arabic">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description">
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
                        Save Designation
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
