<x-livewire-tables::bs4.table.cell>
    <code>{{ $row->commodity_id }}</code>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->{"commodity_" . app()->getLocale()} }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->{"unit_" . app()->getLocale()} }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ \App\Domains\Auth\Models\User::find($row->created_by)->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ date('Y-m-d H:i:s', strtotime($row->created_at)) }}
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    @if( null !==  $row->deleted_at)
        <span class="badge badge-danger">{{ __('Deleted') }}</span>
    @else
        <span class="badge badge-success">{{ __('Active') }}</span>
    @endif
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    <div class="dropdown d-inline-block">
        <x-utils.view-button :href="route('admin.commodities-arrival.show', $row->id)" :text="''"/>
        <x-utils.edit-button :href="route('admin.commodities-arrival.edit', $row->id)" :text="''"/>
        @if ($row->trashed())
            <x-utils.form-button :action="route('admin.commodities-arrival.destroy', $row->id)" method="delete" button-class="btn btn-info btn-sm" name="confirm-item" :icon="'fas fa-trash-restore'" :text="''"></x-utils.form-button>
        @else
            <x-utils.delete-button :href="route('admin.commodities-arrival.destroy', $row->id)" :text="''" />
        @endif
    </div>
</x-livewire-tables::bs4.table.cell>
