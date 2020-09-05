@extends('layouts.default')
@section('pageTitle', 'Dashboard')

@section('content')
    <div class="m-portlet ">
        <div class="m-portlet__body  m-portlet__body--no-padding">
            <div class="row m-row--no-padding m-row--col-separator-xl">
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::Total Profit-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Total Frofit
                            </h4><br>
                            <span class="m-widget24__desc">
													All Customs Value
												</span>
                            <span class="m-widget24__stats m--font-brand">
													$18M
												</span>
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-brand" role="progressbar" style="width: 78%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
													Change
												</span>
                            <span class="m-widget24__number">
													78%
												</span>
                        </div>
                    </div>

                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                New Feedbacks
                            </h4><br>
                            <span class="m-widget24__desc">
													Customer Review
												</span>
                            <span class="m-widget24__stats m--font-info">
													1349
												</span>
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-info" role="progressbar" style="width: 84%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
													Change
												</span>
                            <span class="m-widget24__number">
													84%
												</span>
                        </div>
                    </div>

                    <!--end::New Feedbacks-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                New Orders
                            </h4><br>
                            <span class="m-widget24__desc">
													Fresh Order Amount
												</span>
                            <span class="m-widget24__stats m--font-danger">
													567
												</span>
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-danger" role="progressbar" style="width: 69%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
													Change
												</span>
                            <span class="m-widget24__number">
													69%
												</span>
                        </div>
                    </div>

                    <!--end::New Orders-->
                </div>
                <div class="col-md-12 col-lg-6 col-xl-3">

                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                New Users
                            </h4><br>
                            <span class="m-widget24__desc">
													Joined New User
												</span>
                            <span class="m-widget24__stats m--font-success">
													276
												</span>
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-success" role="progressbar" style="width: 90%;"
                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="m-widget24__change">
													Change
												</span>
                            <span class="m-widget24__number">
													90%
												</span>
                        </div>
                    </div>

                    <!--end::New Users-->
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-12">

            <!--begin:: Widgets/Support Cases-->
            <div class="m-portlet  m-portlet--full-height ">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Support Cases
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                                <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
                                    <i class="la la-ellipsis-h m--font-brand"></i>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__section m-nav__section--first">
                                                        <span class="m-nav__section-text">Quick Actions</span>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                            <span class="m-nav__link-text">Activity</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                            <span class="m-nav__link-text">Messages</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-info"></i>
                                                            <span class="m-nav__link-text">FAQ</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="" class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                            <span class="m-nav__link-text">Support</span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__separator m-nav__separator--fit">
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-widget16">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="m-widget16__head">
                                    <div class="m-widget16__item">
															<span class="m-widget16__sceduled">
																Type
															</span>
                                        <span class="m-widget16__amount m--align-right">
																Amount
															</span>
                                    </div>
                                </div>
                                <div class="m-widget16__body">

                                    <!--begin::widget item-->
                                    <div class="m-widget16__item">
															<span class="m-widget16__date">
																EPS
															</span>
                                        <span class="m-widget16__price m--align-right m--font-brand">
																+78,05%
															</span>
                                    </div>

                                    <!--end::widget item-->

                                    <!--begin::widget item-->
                                    <div class="m-widget16__item">
															<span class="m-widget16__date">
																PDO
															</span>
                                        <span class="m-widget16__price m--align-right m--font-accent">
																21,700
															</span>
                                    </div>

                                    <!--end::widget item-->

                                    <!--begin::widget item-->
                                    <div class="m-widget16__item">
															<span class="m-widget16__date">
																OPL Status
															</span>
                                        <span class="m-widget16__price m--align-right m--font-danger">
																Negative
															</span>
                                    </div>

                                    <!--end::widget item-->

                                    <!--begin::widget item-->
                                    <div class="m-widget16__item">
															<span class="m-widget16__date">
																Priority
															</span>
                                        <span class="m-widget16__price m--align-right m--font-brand">
																+500,200
															</span>
                                    </div>

                                    <!--end::widget item-->

                                    <!--begin::widget item-->
                                    <div class="m-widget16__item">
															<span class="m-widget16__date">
																Net Prifit
															</span>
                                        <span class="m-widget16__price m--align-right m--font-brand">
																$18,540,60
															</span>
                                    </div>

                                    <!--end::widget item-->
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="m-widget16__stats">
                                    <div class="m-widget16__visual">
                                        <div id="m_chart_support_tickets" style="height: 180px"><svg height="180" version="1.1" width="170" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.765625px; top: -0.28125px;"><desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.2.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs><path fill="none" stroke="#00c5dc" d="M89,142.66666666666666A52.666666666666664,52.666666666666664,0,0,0,139.66984779197378,104.36468943332879" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#00c5dc" stroke="#ffffff" d="M89,145.66666666666666A55.666666666666664,55.666666666666664,0,0,0,142.55610494468115,105.18293123649309L160.19434310011508,110.18329781138601A74,74,0,0,1,89,164Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#716aca" d="M139.66984779197378,104.36468943332879A52.666666666666664,52.666666666666664,0,1,0,55.27072907858244,130.44890679471317" stroke-width="2" opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 1;"></path><path fill="#716aca" stroke="#ffffff" d="M142.55610494468115,105.18293123649309A55.666666666666664,55.666666666666664,0,1,0,53.349441494451064,132.7529584475766L38.40609361787366,150.67336019206977A79,79,0,1,1,165.00477168796067,111.54703414999318Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="none" stroke="#f4516c" d="M55.27072907858244,130.44890679471317A52.666666666666664,52.666666666666664,0,0,0,88.98345427896326,142.66666406767087" stroke-width="2" opacity="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); opacity: 0;"></path><path fill="#f4516c" stroke="#ffffff" d="M53.349441494451064,132.7529584475766A55.666666666666664,55.666666666666664,0,0,0,88.9825118011827,145.66666391962679L88.97675221474586,163.99999634824638A74,74,0,0,1,41.608239591425956,146.83327410396407Z" stroke-width="3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="89" y="80" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="15px" stroke="none" fill="#a7a7c2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 15px; font-weight: 800;" font-weight="800" transform="matrix(1.549,0,0,1.549,-49.1373,-48.5882)" stroke-width="0.6455696202531647"><tspan dy="5.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Profit</tspan></text><text x="89" y="100" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="14px" stroke="none" fill="#a7a7c2" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-family: Arial; font-size: 14px;" transform="matrix(1.0972,0,0,1.0972,-8.6627,-8.9444)" stroke-width="0.9113924050632912"><tspan dy="5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">70</tspan></text></svg>
                                        </div>
                                    </div>
                                    <div class="m-widget16__legends">
                                        <div class="m-widget16__legend">
                                            <span class="m-widget16__legend-bullet m--bg-info"></span>
                                            <span class="m-widget16__legend-text">20% Margins</span>
                                        </div>
                                        <div class="m-widget16__legend">
                                            <span class="m-widget16__legend-bullet m--bg-accent"></span>
                                            <span class="m-widget16__legend-text">80% Profit</span>
                                        </div>
                                        <div class="m-widget16__legend">
                                            <span class="m-widget16__legend-bullet m--bg-danger"></span>
                                            <span class="m-widget16__legend-text">10% Lost</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end:: Widgets/Support Stats-->
        </div>
    </div>
@endsection
