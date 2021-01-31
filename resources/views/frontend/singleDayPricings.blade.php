@extends('frontend.template')
@section('content')
<input style="display:none;" id="i18n" value="{{__( app()->getLocale() )}}"/>

    <!--======  banner ====== -->
    <section class="banner" style="background-image:url(img/slide1.jpg);overflow:hidden;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="banner-heading">
                        <h2>{{ __('Daily Price Information') }}</h2>
                    </div>
                    <div class="banner-link">
                        <ul>
                            <li>
                                <a href="/">{{__('Home')}}</a>
                            </li>
                            <li>
                                <span class="active">{{ __('Daily Price Information') }}</span>
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
						<h4>{{ __('To price on commodity, please supply desired date') }}</h4>
                        <div class="blog-detail-content">
                            <ul class="post-detail-meta" style="border-top:none;">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user"></i>{{__('Kalimati Fruits and Vegetable Market Development Board')}}
                                    </a>
                                </li>
							</ul>
								<div class="para">
									<div class="comment-box">
									<form id="queryFormDues" action="#" class="comment-form" method="POST">
											<input type="hidden" id="csrf" name="_token" value="{{ csrf_token() }}" />
										<div class="row">
											<div class="col-sm-3">
												<input id="datePricing" name="datePricing" type="text" class="form-control datePricing-{{ __( app()->getLocale() ) }}" placeholder="{{__('Date for price information')}}">
											</div>
											<div class="col-sm-3">
												<button id="findSpecificDay" type="submit" class="btn comment-btn">{{__('Check Prices')}}</button>
											</div>
										</div>

									</form>
								</div>
                            </div>
                        </div>
                    </div>
				</div>
				<div class="col-md-12">
					<div class="project-detail">
						<h4>{{ __('Daily Price Information') }} {{ isset( $date ) ? " - $date" : ''}}</h4>
						<div class="pro-info">
						<table id="commodityPriceParticular" class="display" style="width:100%">
							<thead>
							<tr>
								<th>{{__('Commodity')}}</th>
								<th>{{__('Unit')}}</th>
								<th>{{__('Minimum')}}</th>
								<th>{{__('Maximum')}}</th>
								<th>{{__('Average')}}</th>
							</tr>
							</thead>
							<tbody>
							@foreach( App\Models\commodityPriceDaily::getPrice( isset( $paramDate ) ? $paramDate : null ) as $index => $value )
							<tr>
								<td>{{ $value->commodityname }}</td>
								<td>{{ $value->commodityunit }}</td>
								<td>{{ 'ne' === __( app()->getLocale() ) ? 'रू' : 'Rs' }}. {{ App\Models\commodityMaster::digits( $value->minprice ) }}</td>
								<td>{{ 'ne' === __( app()->getLocale() ) ? 'रू' : 'Rs' }}. {{ App\Models\commodityMaster::digits( $value->maxprice ) }}</td>
								<td> {{ App\Models\commodityMaster::digits( ( $value->minprice +  $value->maxprice ) / 2 , true ) }}</td>
							</tr>
							@endforeach
							</tbody>
							</table>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
@endsection