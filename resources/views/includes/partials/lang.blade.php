@foreach(collect(config('boilerplate.locale.languages'))->sortBy('name') as $code => $details)
@if($code !== app()->getLocale())
	<li class="dropdown-item">
		<a href="{{ route('locale.change', $code) }}">{{ __(getLocaleName($code)) }}</a>
	</li>
@endif
@endforeach
