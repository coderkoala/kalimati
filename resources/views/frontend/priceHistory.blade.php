@extends('frontend.template')
@section('content')
<input style="display:none;" id="i18n" value="{{__( app()->getLocale() )}}"/>

    <section class="banner" style="background-image:url({{ asset('img/slide1.jpg') }});overflow:hidden;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="banner-heading">
                        <h2>{{ __('Commodity Price History') }}</h2>
                    </div>
                    <div class="banner-link">
                        <ul>
                            <li>
                                <a href="/">{{__('Home')}}</a>
                            </li>
                            <li>
                                <span class="active">{{ __('Commodity Price History') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="blog sp-70-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-push-3">
                    <div class="blog-detail">
						<h4>{{ __('Commodity Price History Lookup') }}</h4>
                        <div class="blog-detail-content">
								<div class="para">
									<div class="comment-box">
									<form id="queryAPIPriceHistory" action="{{ route('api.price-history', '') }}" class="comment-form" method="GET">
											<input type="hidden" id="csrf" name="_token" value="{{ csrf_token() }}" />
										<div class="row">
                                            <div class="col-md-4">
                                                <input id="from" placeholder="From Date" class="form-control" type="date" value="{{ date('Y-m-d', strtotime(App\Models\commodityPriceDaily::getDateMax() . ' -180 days')) }}">
                                            </div>
                                            <div class="col-md-4">
                                                <input id="to" placeholder="To Date" class="form-control" type="date" value="{{ App\Models\commodityPriceDaily::getDateMax() }}">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="sel-wrap">
                                                    <select
                                                    class="form-control"
                                                    id="commodity_selector"
                                                    data-locale="{{ app()->getLocale() }}"
                                                    data-date="{{ __('Date') }}"
                                                    data-minimum="{{ __('Minimum') }}"
                                                    data-average="{{ __('Average') }}"
                                                    data-maximum="{{ __('Maximum') }}"
                                                    data-message="{{ __("frontend.warning_too_many_requests") }}"
                                                    data-title="{{ __("Error!") }}"
                                                    >
                                                        <option selected="selected" disabled="">{{ __('Commodity Name') }}</option>
                                                        @foreach (\App\Models\Backend\Commodities::all() as $commodity)
                                                            <option value="{{ $commodity->commodity_id }}">{{ ($commodity->{'commodity_' . app()->getLocale()}) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
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
						<h4 class="bottom-head">{{ __('Commodity Price History') }} {{ isset( $date ) ? " - $date" : ''}}</h4>
						<div id="pro-info" class="pro-info">
                            <div class="alert alert-warning m-3 p-3">
                                {{ __('frontend.price_trends') }}
                            </div>
                        </div>
					</div>
				</div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
