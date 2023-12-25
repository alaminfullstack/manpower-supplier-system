<div class="modal-dialog modal-lg modal-dialog-popout" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Show Customer</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="block-content">
                <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <th>Profile Image</th>
                        <td>
                            <div
                                class="block-content block-content-full d-flex align-items-center justify-content-between">
                                <img class="image_src img-avatar img-avatar-thumb img-avatar-rounded shadow-sm img-avatar48 button-image"
                                    src="{{ $customer->image != null ? asset($customer->image) : asset('storage/default/default_image.png') }}"
                                    alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $customer->name }}</td>
                    </tr>
                    <tr>
                        <th>Arabic Name</th>
                        <td>{{ $customer->name_arabic }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <th>Vat Number</th>
                        <td>{{ $customer->vat_number ?? null }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $customer->address }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{!! $customer->status
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-danger"> Inactive</span>' !!}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $customer->email }}</td>
                    </tr>
                
                    <tr>
                        <th>Contact Person</th>
                        <td>{{ $customer->contact_name }}</td>
                    </tr>
                    <tr>
                        <th>Last modified</th>
                        <td>{{ get_system_date_time_format($customer->updated_at) }}</td>
                    </tr>
                </table>
            </div>
            <div class="block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
