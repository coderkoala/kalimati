<x-livewire-tables::bs4.table.cell>
    @php
        $vendor = $row->trader_dues()->first();
        $label = ( $vendor && isset($vendor->tradername) && isset($vendor->shop_id) ) ? "($vendor->shop_id) : {$vendor->tradername}" : $row->payment_uuid;
    @endphp
    @if($row->vendor_id)
        <a href="{{ route('admin.traderduespayment.edit', $row->vendor_id ) }}">{{ $label }}</a>
    @else
        <code>{{ $label }}</code>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if( $row->notify_email )
        <a href="mailto:{{ $row->notify_email }}"><i class="cil-envelope-closed"></i></a>
    @else
        -
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <code>
        @switch($row->payment_channel)
            @case('esewa')
                @lang('Esewa')
                @break
            @case('cips')
                @lang('Connect IPS')
                @break
            @case('web')
                @lang('Web Portal')
                @break
            @break
        @endswitch
    </code>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->paid_on ? __idf(__dt(date('l d, H:i a', strtotime($row->paid_on)))) : __('Unpaid') }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <code>
        @switch($row->status)
            @case('processing')
                <span class="badge badge-info">{{ __('Processing') }}</span>
                @break

            @case('unverified')
                <span class="badge badge-warning">{{ __('Unverified') }}</span>
                @break

            @case('verified')
                <span class="badge badge-success">{{ __('Verified') }}</span>
                @break
            @break

            @case('failed')
                <span class="badge badge-danger">{{ __('Failed') }}</span>
                @break
            @break

            @default
                <span class="badge badge-info">@lang('Processing')</span>
                @break
            @break
        @endswitch
    </code>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ __idf($row->amount_paid) }}
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    <div class="dropdown d-inline-block">
        <x-utils.view-button :href="route('admin.traderduespayment.show', $row->id)" :text="''"/>
    </div>
</x-livewire-tables::bs4.table.cell>
