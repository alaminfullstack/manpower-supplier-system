<div class="modal-dialog modal-lg modal-dialog-popout" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Create New Person</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <!-- Form Grid with Labels -->
                <form method="POST" class="submit-form" action="{{ route('person.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Name</label>
                            <input type="text" id="english" class="form-control" name="name">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Name Arabic</label>
                            <input type="text" id="arabic" class="form-control" name="name_arabic">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Designation</label>
                            <select class="form-control" name="designation_id">
                                <option disabled selected>Select Designation</option>
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation->id }}">{{ $designation->title }} --
                                        {{ $designation->title_arabic }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div id="accordion" class="" role="tablist" aria-multiselectable="true">
                        <div class="block block-rounded mb-1">
                            <div class="block-header block-header-default" role="tab" id="accordion_h1">
                                <a class="fw-semibold mx-auto" data-bs-toggle="collapse" data-bs-parent="#accordion"
                                    href="#accordion_q1" aria-expanded="true" aria-controls="accordion_q1">Exta
                                    Information</a>
                            </div>
                            <div id="accordion_q1" class="collapse" role="tabpanel" aria-labelledby="accordion_h1"
                                data-bs-parent="#accordion">
                                <div class="block-content bg-light border-1">
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-4">
                                            <a class="block block-rounded block-link-pop" href="javascript:void(0)">
                                                <input type="hidden" class="form-control image_input" name="image"
                                                    readonly aria-label="Image" aria-describedby="button-image">
                
                                                <div
                                                    class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                    <img class="image_src img-avatar img-avatar-thumb img-avatar-rounded shadow-sm img-avatar48 button-image" src="{{ asset('storage/default/default_image.png') }}"
                                                        alt="">
                                                    <div class="ms-3 text-end">
                                                        <button class="btn btn-secondary image_button" type="button">Select
                                                            image</button>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label">Email Address</label>
                                            <input type="text" class="form-control" name="email">
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label">Father Name</label>
                                            <input type="text" class="form-control" name="father_name">
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label">Mother Name</label>
                                            <input type="text" class="form-control" name="mother_name">
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label">Permanent Address</label>
                                            <input type="text" class="form-control" name="permanent_address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary mb-3">
                        Save Person
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
