@extends('frontend.template')
@section('content')
<input style="display:none;" id="i18n" value="{{__( app()->getLocale() )}}"/>

    <!--======  banner ====== -->
    <section class="banner" style="background-image:url(img/slide1.jpg);overflow:hidden;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="banner-heading">
                        <h2>{{ __('Trader Dues') }}</h2>
                    </div>
                    <div class="banner-link">
                        <ul>
                            <li>
                                <a href="/">{{__('Home')}}</a>
                            </li>
                            <li>
                                <span class="active">{{ __('Trader Dues') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--======  blog detail ====== -->
    <div class="blog sp-70-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-push-3">
                    <div class="blog-detail">
						<h4>{{ __('To check dues, please supply Trader Identification Number') }}</h4>
                        <div class="blog-detail-content">
                            <ul class="post-detail-meta" style="border-top:none;">
                                <li>
                                    <i class="fa fa-calendar"></i>
                                    <span>{{ $date }}</span> <!--Remove this date -->

                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user"></i>{{__('Kalimati Fruits and Vegetable Market Development Board')}}
                                    </a>
                                </li>
							</ul>
								<div class="alert alert-danger notice-error-404" role="alert">{{  __('No trader with that identification number found.') }}</div>
								<div class="para">
									<div class="comment-box">
									<form id="queryFormDues" action="#" class="comment-form" method="POST">
											<input type="hidden" id="csrf" name="_token" value="{{ csrf_token() }}" />
										<div class="row">
											<div class="col-sm-3">
												<input id="id" name="id" type="text" class="form-control" placeholder="{{__('Trader Identification Number')}}">
											</div>
											<div class="col-sm-3">
												<button id="findfees" type="submit" class="btn comment-btn">{{__('Check Dues')}}</button>
											</div>
										</div>

									</form>
								</div>
                            </div>
                        </div>
                    </div>
				</div>
				<div class="col-md-12">
					<div class="project-detail ajax-hide">
						<h4>{{ __('Trader Dues') }}</h4>
						<div class="pro-info">
							<p>
							{{__('Trader\'s Name')}} :
								<span id="tradername"> Financial Service</span>
							</p>
							<p>
								{{__('Shop Number')}} :
								<span id="shopno"> KC40000</span>
							</p>
							<p>
								{{__('Due Date')}} :
								<span id="duedate"> 24 fevruary 2018</span>
							</p>
							<p>
							{{__('Monthly Rent')}} :
								<span id="mrent"> Rs. 33,000</span>
							</p>
							<p>
							{{__('Late Fee')}} :
								<span id="lfee"> Rs 0.00</span>
							</p>
							<p>
							{{__('Other Amount')}} :
								<span id="otheramt"> Rs 1366</span>
							</p>
							<p>
							{{__('Adjustment')}} :
								<span id="adjustment"> Rs 7657</span>
							</p>
							<p>
							{{__('Total Amount')}} :
								<span id="totalamt"> Rs 12334</span>
							</p>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
@endsection