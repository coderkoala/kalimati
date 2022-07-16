<x-livewire-tables::bs4.table.cell>
    {{ $row->{"title_" . app()->getLocale()} }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @switch($row->type)
        @case('notice')
        <span class="badge bg-info text-white">{{ __('General Notice') }}</span>
        @break

        @case('tender')
            <span class="badge bg-warning text-white">{{ __('Tender Invitations') }}</span>
        @break

        @case('pest')
            <span class="badge bg-success text-white">{{ __('Pesticides Report') }}</span>
        @break

        @case('traders')
            <span class="badge bg-primary text-white">{{ __('Notice for Traders') }}</span>
        @break

        @case('bill_publication')
            <span class="badge bg-secondary text-white">{{ __('Bills Publication') }}</span>
        @break

        @case('publication')
            <span class="badge bg-light text-dark" style="background-color: brown">{{ __('Literature Publication') }}</span>
        @break

        @case('annual')
            <span class="badge text-white" style="background-color: purple">{{ __('General Report') }}</span>
        @break

        @default
            <span class="badge bg-danger text-white">{{ __('General Notice') }}</span>
        @break
    @endswitch
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ \App\Domains\Auth\Models\User::find($row->created_by)->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ __idf(date('Y-m-d, H:i a', strtotime($row->published_at)), false) }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ __idf(date('Y-m-d, H:i a', strtotime($row->created_at)), false) }}
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    @if(is_null($row->deleted_at))
        <span class="badge bg-success text-white">{{ __('Active') }}</span>
    @else
        <span class="badge bg-danger text-white">{{ __('Inactive') }}</span>
    @endif
</x-livewire-tables::bs4.table.cell>


<x-livewire-tables::bs4.table.cell>
    <div class="dropdown d-inline-block">
        <x-utils.view-button :href="route('admin.notices.show', $row->id)" :text="''"/>
        <x-utils.edit-button :href="route('admin.notices.edit', $row->id)" :text="''"/>
        @if ($row->trashed())
            <x-utils.form-button :action="route('admin.notices.destroy', $row->id)" method="delete" button-class="btn btn-info btn-sm" name="confirm-item" :icon="'fas fa-trash-restore'" :text="''"></x-utils.form-button>
        @else
            <x-utils.delete-button :href="route('admin.notices.destroy', $row->id)" :text="''" />
        @endif
    </div>
</x-livewire-tables::bs4.table.cell>
