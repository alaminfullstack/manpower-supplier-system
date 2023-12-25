<div class="modal-dialog modal-lg modal-dialog-popout" role="document">
    <div class="modal-content">
        <div class="block block-rounded block-themed block-transparent mb-0">
            <div class="block-header bg-primary-dark">
                <h3 class="block-title">Show Person</h3>
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
                                    src="{{ $person->image != null ? asset($person->image) : asset('storage/default/default_image.png') }}"
                                    alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td>{{ $person->name }}</td>
                    </tr>
                    <tr>
                        <th>Arabic Name</th>
                        <td>{{ $person->name_arabic }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $person->phone }}</td>
                    </tr>
                    <tr>
                        <th>Designation</th>
                        <td>{{ $person->designation->title ?? null }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $person->address }}</td>
                    </tr>
                    <tr>
                        <th>Is Available</th>
                        <td>{!! $person->is_available
                            ? '<span class="badge bg-success">Available</span>'
                            : '<span class="badge bg-danger"> Not Available</span>' !!}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{!! $person->status
                            ? '<span class="badge bg-success">Active</span>'
                            : '<span class="badge bg-danger"> Inactive</span>' !!}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $person->email }}</td>
                    </tr>
                    <tr>
                        <th>Father Name</th>
                        <td>{{ $person->father_name }}</td>
                    </tr>
                    <tr>
                        <th>Mother Name</th>
                        <td>{{ $person->mother_name }}</td>
                    </tr>
                    <tr>
                        <th>Permanent Address</th>
                        <td>{{ $person->permanent_address }}</td>
                    </tr>
                    <tr>
                        <th>Last modified</th>
                        <td>{{ get_system_date_time_format($person->updated_at) }}</td>
                    </tr>
                </table>
            </div>
            <div class="block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
