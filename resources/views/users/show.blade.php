@extends('layouts.default')
@section('pageTitle', $pageTitle)
@push('style')
    <style>
        .m-badge {
            padding: 0px 9px;
        }
    </style>
@endpush
@section('content')
    <div class="m-portlet m-portlet--tab">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text"><i class="far fa-plus-square pr-2"></i>User Detail</h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <a href="{{ route('user.list') }}" class="btn btn-primary m-btn m-btn--icon"><i class="fas fa-book-reader pr-2"></i>User List</a>
            </div>
        </div>
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 pl0">
                        <div class="m-portlet m-portlet--full-height  ">
                            <div class="m-portlet__body">
                                <div class="m-card-profile">
                                    <div class="m-card-profile__title m--hide">
                                        Your Profile
                                    </div>
                                    <div class="m-card-profile__pic">
                                        <div class="m-card-profile__pic-wrapper">
                                            <img src="{{url('storage/user_image/'.$user->user_image)}}" alt="User image">
                                        </div>
                                    </div>
                                    <div class="m-card-profile__details">
                                        <span class="m-card-profile__name">{{$user->name}}</span>
                                        <a href="" class="m-card-profile__email m-link">{{ $user->email }}</a>
                                    </div>
                                </div>
                                <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                                    <li class="m-nav__separator m-nav__separator--fit my-2"></li>

                                    <li class="m-nav__item">
                                        <div class="m-nav__link">
                                            <a role="button" href="#" class="btn btn-success btn-block">Status: {{$user->status == 1 ? 'Active' : 'Inactive'}}</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-6 plr0">
                        <div class="m-portlet m-portlet--full-height p-4">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">User Info</h3>
                                        <div>
                                           <p><b>Gender :</b> {{setGender($user->gender)}}</p>
                                           <p><b>Gender :</b> {{date("F jS, Y", strtotime($user->birth_date))}}</p>
                                            <p><b>Latitude :</b> {{$user->location_latitude}}</p>
                                            <p><b>Longitude :</b> {{$user->location_longitude}}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <form class="kt-form kt-form--label-right">
                                    <div class="kt-portlet__body">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-section__body">
                                                <form enctype="multipart/form-data">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <div class="form-group  m-form__group ">
                                                                <label class="form-control-label">Change User Image</label>
                                                                <input type="file" class="form-control m-input" name="title">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="m-form__actions">
                                                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update Image</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

