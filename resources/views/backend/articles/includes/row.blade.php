<x-livewire-tables::bs4.table.cell>
    {{ $row->{"title_" . app()->getLocale()} }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <code>{{ $row->slug }}</code>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ \App\Domains\Auth\Models\User::find($row->user_id)->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ date('Y-m-d H:i:s', strtotime($row->created_at)) }}
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    @switch($row->status)
        @case('draft')
            <span class="badge badge-warning">{{ __('Draft') }}</span>
            @break

        @case('published')
            <span class="badge badge-success">{{ __('Published') }}</span>
            @break

        @case('archived')
            <span class="badge badge-secondary">{{ __('Archived') }}</span>
            @break

        @default
            <span class="badge badge-dark">{{ __('Unknown') }}</span>
    @endswitch
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    <div class="dropdown d-inline-block">
        <x-utils.view-button :href="route('admin.articles.show', $row->id)" :text="''"/>
        <x-utils.edit-button :href="route('admin.articles.edit', $row->id)" :text="''"/>
        @if ($row->trashed())
            <x-utils.form-button :action="route('admin.articles.destroy', $row->id)" method="delete" button-class="btn btn-info btn-sm" name="confirm-item" :icon="'fas fa-trash-restore'" :text="''"></x-utils.form-button>
        @else
            <x-utils.delete-button :href="route('admin.articles.destroy', $row->id)" :text="''" />
        @endif
    </div>
</x-livewire-tables::bs4.table.cell>
