<div class="modal-dialog modal-lg modal-dialog-popout" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Edit Customer</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <!-- Form Grid with Labels -->
                <form method="POST" class="submit-form" action="{{ route('customer.update',$customer->id) }}">
                  @csrf
                  @method('put')
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="english" name="name" value="{{ $customer->name }}">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Arabic Name</label>
                            <input type="text" class="form-control" id="arabic" name="name_arabic" value="{{ $customer->name_arabic }}">
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Vat Number</label>
                            <input type="text" class="form-control" name="vat_number" value="{{ $customer->vat_number }}">
                        </div>


                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ $customer->address }}" step="0.1">
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" @if($customer->status == 1) selected @endif>Active</option>
                                <option value="0" @if($customer->status == 0) selected @endif>Inactive</option>
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
                                            <a class="block block-rounded block-link-pop border" href="javascript:void(0)">
                                                <input type="hidden" class="form-control image_input" value="{{ $customer->image }}" name="image"
                                                    readonly aria-label="Image" aria-describedby="button-image">
                
                                                <div
                                                    class="block-content block-content-full d-flex align-items-center justify-content-between">
                                                    <img class="image_src img-avatar img-avatar-thumb img-avatar-rounded shadow-sm img-avatar48 button-image" src="{{ $customer->image != null ? asset($customer->image) : asset('storage/default/default_image.png') }}"
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
                                            <input type="text" class="form-control" name="email" value="{{$customer->email}}">
                                        </div>
                                        <div class="col-12 col-md-6 mb-4">
                                            <label class="form-label">Contact Person</label>
                                            <input type="text" class="form-control" name="contact_name" value="{{$customer->contact_name}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary mb-3">
                        Save Customer
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
