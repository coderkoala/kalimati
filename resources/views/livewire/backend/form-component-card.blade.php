<div>
    @if (1 < count($this->formLayout))
        <ul class="nav nav-tabs" role="tablist">
            @foreach ($this->formLayout as $formKeyTuple => $arrayFields)
                <li class="nav-item" wire:ignore>
                    <a class="nav-link {{ $formKeyTuple === array_key_first($this->formLayout) ? 'active' : '' }}"
                        data-toggle="tab"
                        href="#tab-{{ Str::slug($formKeyTuple, '-') }}-{{ $this->hash }}"
                        role="tab">
                        {{ $formKeyTuple }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    <div class="card"
        style="{{ isset($this->heirarchy) && 'slave' === $this->heirarchy ? 'background:whitesmoke' : 'background:white' }}">
        <div class="card-body">
            @include('livewire.backend.includes.fields')
        </div>
        <div class="pb-3 pr-3 row">
            <div class="col-sm-12 text-right">
                <button class="btn btn-sm btn btn-{{ isset($this->heirarchy) && 'slave' === $this->heirarchy ? 'primary' : 'secondary' }}" type="button" wire:click="submit">@lang('Add
                    Record')</button>
            </div>
        </div>
    </div>

    @include('livewire.backend.includes.scripts')
</div>
