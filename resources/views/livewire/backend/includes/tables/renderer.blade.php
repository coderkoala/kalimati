<table class="table table-hover">
    <thead>
        <tr>
            @foreach ($this->fields[$field]['table']['columns'] as $column => $columnLabel)
                <th scope="col">{{ __($columnLabel) }}</th>
            @endforeach
            <th scope="col">{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @if (is_array($this->data[$field]) && !empty($this->data[$field]))
            @foreach ($this->data[$field] as $index => $dataTuple)
                <tr>
                    @foreach ($this->fields[$field]['table']['columns'] as $column => $columnLabel)
                        <td>
                            {{ isset($dataTuple[$column])? (strlen($dataTuple[$column]) > 20? substr($dataTuple[$column], 0, 16) . ' ...': $dataTuple[$column]): '-' }}
                        </td>
                    @endforeach
                    <td><span wire:click="$emit('delete-tuple-data', '{{ $field }}', '{{ $index }}' )" role="button"><i class="fas fa-trash text-danger"></i>&nbsp;{{ __('Delete') }}</span></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>{{ __('No data added yet') }}</td>
            </tr>
        @endif
    </tbody>
</table>
