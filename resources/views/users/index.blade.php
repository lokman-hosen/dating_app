@extends('layouts.default')
@section('pageTitle', $pageTitle)

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text"><i class="fas fa-list-ul pr-2"></i>Prescription List</h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="m-section__content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <div class="table m-table table-responsive">
                                        @include('common/datatable')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- delete lesson modal start-->
    <div class="modal fade" id="user-like-modal" tabindex="-1" role="dialog" aria-labelledby="userLikeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Test</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group  m-form__group mb-0">
                                <input type="hidden" name="owner-user-id" id="ownerUserId">
                                <h5 class="text-danger mb-0">Are you sure?</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-brand" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="button" class="btn btn-success" id="submit-btn"><i class="fa fa-save"></i> Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete lesson modal end-->

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.like-button', function (e) {
            var ownerUserId = $(this).data('owner-user-id');
            $('#ownerUserId').val(ownerUserId);
            $('#user-like-modal').modal('show');
            //alert(baseUrl+ 'admin/lesson/'+lessonId,)
        });

        $('#submit-btn').click(function (e) {
            e.preventDefault();
            var ownerUserId = $('#ownerUserId').val();
            $.ajax({
                //type: 'PUT',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                //url: baseUrl+ 'admin/lesson/'+lessonId,
                url: baseUrl+ 'user-profile-like/'+ownerUserId,
                dataType: 'JSON',
                data: {
                    'owner-user-id': ownerUserId,
                },
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#user-like-modal').modal('hide');

                    if (response.status){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: "You liked selected profile",
                            type: 'success',
                            showConfirmButton: false,
                            timer: 900
                        })
                    }
                    location.reload();
                },
                error: function (xhr) {
                    $('#user-like-modal').modal('hide');
                    //location.reload();
                    console.log(xhr.responseText);
                }
            });
        })
    </script>
@endpush