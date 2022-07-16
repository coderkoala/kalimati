<x-livewire-tables::bs4.table.cell>
    <code>{{ $row->trader_id }}</code>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->tradername }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <code>{{ $row->shop_id }}</code>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->due_date }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->monthly_rent }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->late_fee }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->other_amount }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->adjustment }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->total_amount }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <div class="dropdown d-inline-block">
        <x-utils.link :href="route('admin.traderdues.show', $row->id)" class="btn btn-info btn-sm" icon="fas fa-search" />
        <x-utils.link :href="route('admin.traderdues.edit', $row->id)" class="btn btn-primary btn-sm" icon="fas fa-pen" />
        <x-utils.form-button :action="route('admin.traderdues.destroy', $row->id)" method="delete" button-class="btn btn-danger btn-sm" name="confirm-item" :icon="'fas fa-trash'" :text="''"></x-utils.form-button>
    </div>
</x-livewire-tables::bs4.table.cell>
