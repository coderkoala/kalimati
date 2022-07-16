@component('mail::message')
#### @lang('email.i18n_salutations'),

@lang('email.i18n_body_start', ['date' => __idf(date('Y-m-d'), false)])

@foreach ($introLines as $line)
{{ $line }}

@endforeach

@if(isset($daily_prices))
@component('mail::table')
| {{ __('Commodity') }} | {{ __('Minimum') }}/{{ __('Maximum') }} | {{ __('Average') }} |
|:--------- | -------:| -------:|
@foreach ($daily_prices as $daily_prices_item)
| {{ $daily_prices_item->commodityname }}({{ $daily_prices_item->commodityunit }}) | {{ 'रू' }} {{ __idf($daily_prices_item->minprice, true) }} / {{ 'रू' }} {{ __idf($daily_prices_item->maxprice, true) }} | {{ 'रू' }} {{ __idf($daily_prices_item->avgprice, true) }} |
@endforeach
@endcomponent
@endif

@lang('email.i18n_body_end')


{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

@lang('email.i18n_signature')<br>
@lang('email.i18n_header')

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
