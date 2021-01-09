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
                        <div class="blog-detail-content">
                            <ul class="post-detail-meta" style="border-top:none;">
                                <li>
                                    <i class="fa fa-calendar"></i>
                                    <span>{{ $date }}</span>

                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user"></i>{{__('Kalimati Fruits and Vegetable Market Development Board')}}
                                    </a>
                                </li>
                            </ul>
								<div class="para">
									<div class="comment-box">
									<form action="#" class="comment-form">
										<div class="row">
											<div class="col-sm-3">
												<input id="shopid" type="text" class="form-control" placeholder="{{__('Shop Identification Number')}}">
											</div>
											<div class="col-sm-3">
												<button type="submit" class="btn comment-btn">{{__('Check Dues')}}</button>
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
								date :
								<span> 24 fevruary 2018</span>
							</p>
							<p>
								Location :
								<span> New York, NY</span>
							</p>
							<p>
								Category :
								<span> Financial Service</span>
							</p>
							<p>
								Category :
								<span> Home Loan</span>
							</p>
						</div>
					</div>
					<div class="user-comments ajax-hide" style="border-bottom:none;">
						<div class="comment-block">
							<div class="user-post-content">
								<a class="reply" onclick="jQuery('#shopid').val('')" >
									<i class="fa fa-reply"></i> {{__('Check Another')}}
								</a>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
@endsection