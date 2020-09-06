@extends('layouts.default')
@section('pageTitle', $pageTitle)
@push('style')
    <style>
        .modal .modal-content .modal-header .close:before {
            content: "X" !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text"><i class="fas fa-list-ul pr-2"></i>User List(Around 5 km from you location)</h3>
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

    <!-- like confirm modal start-->
    <div class="modal fade" id="user-like-modal" tabindex="-1" role="dialog" aria-labelledby="userLikeLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Like status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
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
    <!-- like confirm modal end-->

@endsection

@push('scripts')
    <script src="{{asset('assets/global/plugins/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/scripts/charts.js')}}"></script>
    <script>
        $(document).on('click', '.like-button', function (e) {
            var ownerUserId = $(this).data('owner-user-id');
            $('#ownerUserId').val(ownerUserId);
            $('#user-like-modal').modal('show');
        });

        $('#submit-btn').click(function (e) {
            e.preventDefault();
            var ownerUserId = $('#ownerUserId').val();
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
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
                        var table = $('#dataTable').DataTable();
                        table.destroy();

                        var userTableColumn = [
                            {"data":"id","name":"id"},
                            {"data":"user_image","name":"user_image"},
                            {"data":"name","name":"name"},
                            {"data":"distance","name":"distance"},
                            {"data":"gender","name":"gender"},
                            {"data":"age","name":"age"},
                            {"data":"action","name":"action"}
                        ];
                        generateDatatable('dataTable', userTableColumn, baseUrl+'user/get-data', 1, 'asc');
                        if (response.mutualFriend){
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: "It's a Match!",
                                type: 'success',
                                showConfirmButton: true,
                            })
                        }else{
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: "You liked selected user profile",
                                type: 'success',
                                showConfirmButton: false,
                                timer: 900
                            })
                        }
                    }
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