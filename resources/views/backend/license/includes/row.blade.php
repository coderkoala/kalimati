<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <code>{{ $row->license_uuid }}</code>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ \App\Domains\Auth\Models\User::find($row->user_id)->name }}
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    {{ date('Y-m-d H:i:s', strtotime($row->valid_until)) }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ date('Y-m-d H:i:s', strtotime($row->created_at)) }}
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    @if (strtotime('today midnight') <= strtotime($row->created_at))
        <span class="badge badge-success">{{ __('Active') }}</span>
    @else
        <span class="badge badge-danger">{{ __('Expired') }}</span>
    @endif
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    <div class="dropdown d-inline-block">
        <x-utils.view-button :href="route('admin.license.show', $row->id)" :text="''"/>
        <x-utils.edit-button :href="route('admin.license.edit', $row->id)" :text="''"/>
        @if ($row->trashed())
            <x-utils.form-button :action="route('admin.license.destroy', $row->id)" method="delete" button-class="btn btn-info btn-sm" name="confirm-item" :icon="'fas fa-trash-restore'" :text="''"></x-utils.form-button>
        @else
            <x-utils.delete-button :href="route('admin.license.destroy', $row->id)" :text="''" />
        @endif
    </div>
</x-livewire-tables::bs4.table.cell>
