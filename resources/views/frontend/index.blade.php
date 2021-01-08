@extends('frontend.template')
@section('content')
<input style="display:none;" id="i18n" value="{{__( app()->getLocale() )}}"/>
<!-- ====== top slider ====== -->
<section class="top-slider">
	<div class="theme-slider main-slider owl-carousel owl-theme" data-items="1" data-loop="true" data-pause-on-hover="true" data-autoplay="true"
		data-dots="true" data-nav="true" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="1"
		data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="1" data-r-small-nav="false" data-r-small-dots="true"
		data-r-medium="1" data-r-medium-nav="true" data-r-medium-dots="true" data-r-large="1" data-r-large-nav="true" data-r-large-dots="true">
		<div class="item">
			<img src="img/slide1.jpg" alt="slide">
			<div class="slide-overlay">
				<div class="slide-table">
					<div class="slide-table-cell">
						<div class="container">
							<div class="slide-content">
								<a href="#commodityPricesDailyTable" class="btn btn-theme btn-active">{{__('check prices')}}</a>
								<a href="#contact" class="btn btn-theme">{{ __('Contact us') }}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="item">
			<img src="img/slide2.jpg" alt="slide">
			<div class="slide-overlay">
				<div class="slide-table">
					<div class="slide-table-cell">
						<div class="container">
							<div class="slide-content">
								<a href="#commodityPricesDailyTable" class="btn btn-theme btn-active">{{__('check prices')}}</a>
								<a href="#contact" class="btn btn-theme">{{ __('Contact us') }}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="item">
			<img src="img/slide3.jpg" alt="slide">
			<div class="slide-overlay">
				<div class="slide-table">
					<div class="slide-table-cell">
						<div class="container">
							<div class="slide-content">
								<a href="#commodityPricesDailyTable" class="btn btn-theme btn-active">{{__('check prices')}}</a>
								<a href="#contact" class="btn btn-theme">{{ __('Contact us') }}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="grow-business" style="margin-top:4rem">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="all-title">
					<p>
						{{ __("The need to bring improvement in the state of Kalimati market was identified as a priority. Hence an agreement was signed in 1989 between Government of Nepal (GON) and United Nation's Capital Development Fund (UNCDF) to construct and equip the market with physical infrastructures. The present facilities are the outcome of that agreement.") }}
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6" id="archetypeParent">
				<h4 class="h-border">{{ __('Introduction')}}</h4>
				<div class="abt-para">
					@if ( 'ne' !== __( app()->getLocale() ) )
					<p>
					Kalimati Fruits and Vegetables Markets is the pioneer organized terminal wholesale market in Nepal where retailers, institutional consumers and other bulk consumers procure their supplies. This market alone covers 60 to 70 percent of demand of Kathmandu valley. For giving an organized shape to the marketing of agricultural produce, especially, vegetables and fruits in Kathmandu valley, Kalimati Fruits and Vegetables Wholesale Market was set up by then the Department of Food and Agriculture Marketing Services under the Ministry of Agriculture in 1986.

					<br>The need to bring improvement in the state of Kalimati market was identified as a priority. Hence an agreement (NEP/89/CO1) was signed in 1989 between Government of Nepal (GON) and United Nation's Capital Development Fund (UNCDF) to construct and equip the market with physical infrastructures. The present facilities are the outcome of that agreement.

					<br>In 1995, government felt the need of an independent body for the efficient operation and management of the market. Keeping this in view, Kalimati Fruits and Vegetables Wholesale Market Development Board was formulated on 13 February 1995 under the Development Board Act 1957. Likewise, with a view to manage the operations of the market in on organized way and ensuring planned development of agriculture marketing, the Government of Nepal has formulated new organizational set up "Kalimati Fruits and Vegetables Market Development Board 2002" replacing the previous one.
					</p>
					@else
					<p>
					लामो समयदेखि काठमाडौं उपत्यका तथा अन्य क्षेत्रको तरकारी तथा फलफूलहरुको वेचविखन गर्ने थलोको रुपमा रहदै आएको कालीमाटी बजार वि.सं. २०४३ आश्विन १५ गते देखि तत्कालिन खाद्य तथा कृषि बजार सेवा विभाग अन्तर्गत सञ्चालनमा आएको थियो । बजार सञ्चालनको क्रममा बजार आगमन र कारोबारको स्थितिमा भएको विस्तार एवं बजार प्रयोगकर्ताहरुको बढ्दो चापलाई मध्यनजर गरी नेपाल सरकार तथा संयुक्त राष्ट्रसंघीय पूँजी विकास कोष (UNCDF) को सहयोगमा हालका अधिकांश संरचना निर्माण भएका हुन् ।

					<br>कालीमाटी तरकारी बजारको निर्माण तथा व्यवस्थापनको लागि एउटा स्वायत्त निकायको आवश्यकता महशुस गरी नेपाल सरकारद्वारा विकास समिति ऐन-२०१३ अन्तर्गत वि.सं. २०५१ फागुन १ गते "कालीमाटी फलफूल तथा तरकारी थोक बजार विकास समिति (गठन) आदेश, २०५१" जारी गरियो । समितिको कार्य क्षेत्रलाई विस्तार गर्ने अभिप्रायले नेपाल सरकारले वि.सं. २०५८ चैत्र १९ गते साविकको आदेश खारेज गरी सोही ऐन अन्तर्गत "कालीमाटी फलफूल तथा तरकारी बजार विकास समिति(गठन) आदेश, २०५८" जारी गरी सोही अनुसार संघीय संरचना बमोजिम यस समितिलाई संघ अन्तर्गतको निकाय कायम गरिएको छ । नेपाल सरकारबाट निर्माण भएको कृषि उपज बजार बालाजु २०६२ असार महिना देखि समितिले सञ्चालन गर्दै आएको छ ।

					<br>समितिको स्वामित्वमा रहेको कीर्तिपुर नगरपालिका वडा नं.६ चोभारमा करिब २२ रोपनी जग्गामा फलफूल तथा पुष्प बजार निर्माणाधिन अवस्थामा छ । यसैगरी धादिङ्ग नौविसे स्थित आफ्नै स्वामित्वको करिव ४.५ रोपनी जग्गामा सङ्कलन केन्द्र स्थापना गर्ने सोचाई समितिले राखेको छ ।
					</p>
					@endif
				</div>

				<a href="#" class="btn btn-theme btn-active">{{__('read more')}}</a>
				<a href="#contact" class="btn btn-theme">{{__('Contact us')}}</a>
			</div>
			<div id="commodityPricesDailyTable" class="col-md-6" style="flex: 1;">
				<div class="row" style="margin:0">
					<div class="col-sm-12">
						<div class="features-inner even" style="background-color:#1abc9c;">
							<h5 style="padding-top:0">{{__('Daily prices')}} - {{$date }}</h5>
							<table id="commodityDailyPrice" class="display" style="width:100%">
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
							@foreach( App\Models\commodityPriceDaily::getPriceOptimized() as $index => $value )
							<tr>
								<td>{{ $value->commodityname }}</td>
								<td>{{ $value->commodityunit }}</td>
								<td>{{ 'ne' === __( app()->getLocale() ) ? 'रू' : 'Rs' }}. {{ App\Models\commodityMaster::digits( $value->minprice ) }}</td>
								<td>{{ 'ne' === __( app()->getLocale() ) ? 'रू' : 'Rs' }}. {{ App\Models\commodityMaster::digits( $value->maxprice ) }}</td>
								<td>{{ 'ne' === __( app()->getLocale() ) ? 'रू' : 'Rs' }}. {{ App\Models\commodityMaster::digits( $value->avgprice ) }}</td>
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
</section>

<!-- ====== our team ====== -->
<section class="our-team mb-2rem">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="all-title">
					<div class="sec-title">
						<h3>
							<span></span>
						</h3>
					</div>
					<p></p>
				</div>
			</div>
		</div>
		<div class="row flex-force">
			<div class="col-md-3 col-sm-6">
				<div class="team-members">
					<img src="img/team-1.png" alt="member">
					<div class="team-overlay">
						<div class="overlay-content">
							<h4>
								<a href="#">{{__('Dr. Yogendra Kumar Karki')}}</a>
							</h4>
							<h5>{{__('Chair Person')}}</h5>
							<ul class="social">
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="team-members">
					<img src="img/team-2.png" alt="member">
					<div class="team-overlay">
						<div class="overlay-content">
							<h4>
								<a href="#">{{__("Binod Kumar Bhattarai")}}</a>
							</h4>
							<h5>{{__('Executive Director')}}</h5>
							<ul class="social">
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6">
				<div class="team-members">
					<img src="img/team-3.png" alt="member">
					<div class="team-overlay">
						<div class="overlay-content">
							<h4>
								<a href="#">{{__('Binay Shrestha')}}</a>
							</h4>
							<h5>{{__('Deputy Director')}}</h5>
							<ul class="social">
								<li>
									<a href="mailto:binaystha@gmail.com">
										<i class="fas fa-envelope"></i>
									</a>
								</li>
								<li>
									<a href="tel:+977015123086">
										<i class="fas fa-phone"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ====== contact us ====== -->
<section id="contact" class="contact-us mb-4rem" style="margin-top:6rem">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="all-title">
					<div class="sec-title">
						<h3>
							<span>{{__('Contact us')}}</span>
						</h3>
					</div>
					<p>
						{!! __('Kalimati Market welcomes queries. Be it a few questions, or be it proposals for ambitious projects, we are always open ears, and will be more happy to accommodate you as best as we can. <br>Simply reach out to us via phone, Website form or email given below. Please allow upto a business day for email replies, we’re constantly striving to up our customer service game.') !!}
					</p>
				</div>
			</div>
		</div>
		<form action="#">
			<div class="row">
				<div class="col-md-6">
					<input type="text" placeholder="{{__('Full Name')}}" class="form-control">
				</div>
				<div class="col-md-6">
					<input type="Email" placeholder="{{__('Email Address')}}" class="form-control">
				</div>
				<div class="col-md-6">
					<input type="text" placeholder="{{__('Phone no.')}}" class="form-control">
				</div>
				<div class="col-md-6">
					<div class="sel-wrap">
						<select class="form-control custom-select" id="service">
							<option selected='selected' disabled>{{__('Nature of help needed')}}</option>
							<option>{{__('General Query')}}</option>
							<option>{{__('Administration related')}}</option>
							<option>{{__('Suggestion')}}</option>
							<option>{{__('Support')}}</option>
						</select>
					</div>
				</div>
				<div class="col-md-12">
					<textarea name="massage" class="form-control" id="message" placeholder="{{__('Your Query')}}" rows="10"></textarea>
				</div>
				<div class="col-md-12 clearfix">
					<a href="#" class="btn btn-theme send">{{__('submit')}}</a>
				</div>
			</div>
		</form>
	</div>
</section>
@endsection