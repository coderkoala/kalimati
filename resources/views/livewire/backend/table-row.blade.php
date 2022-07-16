@dd($row->toArray(), $this->model::getTableColumns())
@foreach ( array_keys($this->model::getTableColumns()) as $columnTuple )
    <x-livewire-tables::bs4.table.cell>
        {!! $row->{$columnTuple} !!}
    </x-livewire-tables::bs4.table.cell>
@endforeach
