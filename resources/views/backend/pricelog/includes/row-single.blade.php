<x-livewire-tables::bs4.table.cell>
    {{ $row->commodity}}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if( 'wholesale' === $row->price_type)
        <span class="badge bg-info text-light">{{ __('Wholesale') }}</span>
    @else
        <span class="badge bg-warning text-light">{{ __('Retail') }}</span>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ 'रू' }} <code>{{ __idf($row->min_price) }}</code>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ 'रू' }} <code>{{ __idf($row->avg_price) }}</code>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ 'रू' }} <code>{{ __idf($row->max_price) }}</code>
</x-livewire-tables::bs4.table.cell>
