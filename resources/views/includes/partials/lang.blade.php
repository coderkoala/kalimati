@foreach (collect(config('boilerplate.locale.languages'))->sortBy('name') as $code => $details)
    @if ($code !== app()->getLocale())
        <div class="dropdown-item">
            <a href="{{ route('locale.change', $code) }}" class=""><img src="{{ asset("img/" . $code . ".svg") }}" width="15" height="15"/></a>
        </div>
    @endif
@endforeach
