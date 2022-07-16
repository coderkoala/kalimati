<x-livewire-tables::bs4.table.cell>
    <b>{{ __date($row->date) }}</b>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <code>{{ __idf($row->commodity_count, false) }}</code>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if ('wholesale' === $row->price_type)
        <span class="badge bg-info text-light">{{ __('Wholesale') }}</span>
    @else
        <span class="badge bg-warning text-light">{{ __('Retail') }}</span>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <div class="dropdown d-inline-block">
        <x-utils.view-button :href="route('admin.pricelog.show', $row->date)" :text="''" />
        <x-utils.edit-button :href="route('admin.pricelog.edit', $row->date)" :text="''" />
        <x-utils.form-button :action="route('admin.pricelog.destroy', $row->date)" method="delete" button-class="btn btn-danger btn-sm" name="confirm-item"
            :icon="'fas fa-trash'" :text="''"></x-utils.form-button>
    </div>
</x-livewire-tables::bs4.table.cell>
