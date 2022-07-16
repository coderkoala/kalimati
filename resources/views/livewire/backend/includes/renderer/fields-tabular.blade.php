<div class="form-horizontal">

    @foreach ($this->formLayout as $formKeyTuple => $arrayFields)
        @push("tabData-{$this->hash}")
            <div class="tab-pane {{ $formKeyTuple === array_key_first($this->formLayout) ? 'active' : '' }}"
                wire:ignore.self id="tab-{{ Str::slug($formKeyTuple, '-') }}-{{ $this->hash }}" role="tabpanel">
                @foreach ($arrayFields as $individualField)
                    @if (!empty($this->fields[$individualField]['render']))
                        <div
                            class="form-group row{{ isset($this->fields[$individualField]['hidden']) && true === $this->fields[$individualField]['hidden']? ' hidden': '' }}">
                            <label for="{{ $individualField }}"
                                class="col-md-2 col-form-label {{ isset($this->fields[$individualField]['required']) && true === $this->fields[$individualField]['required']? 'font-weight-bold': ' font-weight-normal' }}">@lang($this->fields[$individualField]['label'])</label>
                            <div class="col-md-10">
                                @switch($this->fields[$individualField]['type'])
                                    @case('textarea')
                                        <div wire:ignore>
                                            <div id="{{ $individualField }}-{{ $this->hash }}"
                                                wire:key="{{ $individualField }}-{{ $this->hash }}"
                                                class="textarea-{{ $this->hash }} form-control d-block
                                            @error("data.$individualField") is-invalid @enderror"
                                                data-field="{{ $individualField }}" style="height:10rem; width: 100%">
                                            </div>
                                        </div>
                                    @break

                                    @case('select')
                                        <div wire:ignore>
                                            <select style="width: 100%" name="{{ $individualField }}-{{ $this->hash }}"
                                                id="{{ $individualField }}-{{ $this->hash }}"
                                                wire:key="{{ $individualField }}-{{ $this->hash }}"
                                                class="form-control select2-{{ $this->hash }}
                                            @error("data.$individualField") is-invalid @enderror
                                            d-block {{ isset($this->fields[$individualField]['class']) ? $this->fields[$individualField]['class'] : '' }}"
                                                {!! isset($this->fields[$individualField]['placeholder']) ? " data-placeholder='{$this->fields[$individualField]['placeholder']}'" : '' !!}
                                                {{ true === $this->fields[$individualField]['disabled'] ? ' disabled' : '' }}
                                                {{ true === $this->fields[$individualField]['hidden'] ? ' hidden' : '' }}
                                                {{ isset($this->fields[$individualField]['multiple']['affirm']) &&$this->fields[$individualField]['multiple']['affirm']? " multiple data-limit='{$this->fields[$individualField]['multiple']['limit']}'": '' }}
                                                data-field="{{ $individualField }}"
                                                data-api='{{ isset($this->fields[$individualField]['route']) ? $this->fields[$individualField]['route'] : null }}'>
                                                <option></option>
                                                @if( !empty($this->fields[$individualField]['loadOptions']) )
                                                    @if (is_array($this->fields[$individualField]['model']))
                                                        @foreach ($this->fields[$individualField]['model'] as $tupleKey => $tupleValue)
                                                            <option value="{{ $tupleKey }}">
                                                                {{ empty($this->fields[$individualField]['showPK']) ? '' : "{$tupleKey}" }}
                                                                @lang($tupleValue)</option>
                                                        @endforeach
                                                    @else
                                                        @foreach ($this->fields[$individualField]['model']::select('id', 'name')->get() as $tuple)
                                                            <option value="{{ $tuple->id }}">
                                                                {{ empty($this->fields[$individualField]['showPK']) ? '' : "[{$tuple->id}]" }}
                                                                @lang($tuple->name)</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                        </div>
                                    @break

                                    @case('checkbox')
                                        @if (is_array($this->fields[$individualField]['model']))
                                            @foreach ($this->fields[$individualField]['model'] as $iterator => $tuple)
                                                <div class="form-check">
                                                    <label class="form-check-label"
                                                        for="{{ $individualField }}-{{ $this->hash }}[{{ $iterator }}]">
                                                        <input value="{{ $iterator }}"
                                                            name="{{ $individualField }}-{{ $this->hash }}"
                                                            id="{{ $individualField }}-{{ $this->hash }}[{{ $iterator }}]"
                                                            wire:key="{{ $individualField }}-{{ $this->hash }}[{{ $iterator }}]"
                                                            type="checkbox"
                                                            class="form-check-input
                                                        @error("data.$individualField") is-invalid @enderror
                                                        d-block {{ isset($this->fields[$individualField]['class']) ? $this->fields[$individualField]['class'] : '' }}"
                                                            {{ true === $this->fields[$individualField]['disabled'] ? 'disabled' : '' }}
                                                            {{ true === $this->fields[$individualField]['hidden'] ? 'hidden' : '' }}
                                                            wire:model.lazy="data.{{ $individualField }}.{{ $iterator }}"
                                                            data-model="data.{{ $individualField }}.{{ $iterator }}">
                                                        @lang($tuple)
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach ($this->fields[$individualField]['model']::all() as $iterator => $tuple)
                                                <div class="form-check">
                                                    <label class="form-check-label"
                                                        for="{{ $individualField }}-{{ $this->hash }}[{{ $iterator }}]">
                                                        <input value="{{ $tuple->id }}"
                                                            name="{{ $individualField }}-{{ $this->hash }}"
                                                            id="{{ $individualField }}-{{ $this->hash }}[{{ $iterator }}]"
                                                            wire:key="{{ $individualField }}-{{ $this->hash }}[{{ $iterator }}]"
                                                            type="checkbox"
                                                            class="form-check-input
                                                        @error("data.$individualField") is-invalid @enderror
                                                        d-block {{ isset($this->fields[$individualField]['class']) ? $this->fields[$individualField]['class'] : '' }}"
                                                            {{ true === $this->fields[$individualField]['disabled'] ? 'disabled' : '' }}
                                                            {{ true === $this->fields[$individualField]['hidden'] ? 'hidden' : '' }}
                                                            wire:model.lazy="data.{{ $individualField }}.{{ $iterator }}"
                                                            data-model="data.{{ $individualField }}.{{ $iterator }}">
                                                        @lang($tuple->name)
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif
                                    @break

                                    @case('radio')
                                        @if (is_array($this->fields[$individualField]['model']))
                                            @foreach ($this->fields[$individualField]['model'] as $iterator => $tuple)
                                                <div class="form-check">
                                                    <label class="form-check-label"
                                                        for="{{ $individualField }}-{{ $iterator }}">
                                                        <input value="{{ $iterator }}" name="{{ $individualField }}"
                                                            id="{{ $individualField }}-{{ $iterator }}"
                                                            wire:key="{{ $individualField }}-{{ $this->hash }}-{{ $iterator }}"
                                                            type="radio"
                                                            class="form-check-input
                                                        @error("data.$individualField") is-invalid @enderror
                                                        d-block {{ isset($this->fields[$individualField]['class']) ? $this->fields[$individualField]['class'] : '' }}"
                                                            {{ true === $this->fields[$individualField]['disabled'] ? 'disabled' : '' }}
                                                            {{ true === $this->fields[$individualField]['hidden'] ? 'hidden' : '' }}
                                                            wire:model.lazy="data.{{ $individualField }}"
                                                            data-model="data.{{ $individualField }}">
                                                        @lang($tuple)
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach ($this->fields[$individualField]['model']::all() as $iterator => $tuple)
                                                <div class="form-check">
                                                    <label class="form-check-label"
                                                        for="{{ $individualField }}-{{ $iterator }}">
                                                        <input value="{{ $tuple->id }}" name="{{ $individualField }}"
                                                            id="{{ $individualField }}-{{ $iterator }}"
                                                            wire:key="{{ $individualField }}-{{ $this->hash }}-{{ $iterator }}"
                                                            type="radio"
                                                            class="form-check-input
                                                        @error("data.$individualField") is-invalid @enderror
                                                        d-block {{ isset($this->fields[$individualField]['class']) ? $this->fields[$individualField]['class'] : '' }}"
                                                            {{ true === $this->fields[$individualField]['disabled'] ? 'disabled' : '' }}
                                                            {{ true === $this->fields[$individualField]['hidden'] ? 'hidden' : '' }}
                                                            wire:model.lazy="data.{{ $individualField }}"
                                                            data-model="data.{{ $individualField }}">
                                                        @lang($tuple->name)
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif
                                    @break

                                    @case('bool')
                                        <div class="form-check">
                                            <label class="form-check-label" for="{{ $individualField }}">
                                                <input name="{{ $individualField }}" id="{{ $individualField }}"
                                                    wire:key="{{ $individualField }}-{{ $this->hash }}" type="checkbox"
                                                    class="form-check-input
                                                @error("data.$individualField") is-invalid @enderror
                                                d-block {{ isset($this->fields[$individualField]['class']) ? $this->fields[$individualField]['class'] : '' }}"
                                                    {{ true === $this->fields[$individualField]['disabled'] ? 'disabled' : '' }}
                                                    {{ true === $this->fields[$individualField]['hidden'] ? 'hidden' : '' }}
                                                    wire:model.lazy="data.{{ $individualField }}"
                                                    data-model="data.{{ $individualField }}">
                                                @lang($this->fields[$individualField]['label'])
                                            </label>
                                        </div>
                                    @break

                                    @case('form')
                                        @if ( isset($this->fields[$individualField]['table']['columns']))
                                            @include('livewire.backend.includes.tables.renderer', ['field' => $individualField])
                                        @endif
                                        @if (empty($this->fields[$individualField]['required']))
                                            <div x-data="{ open: false }">
                                                <input type="checkbox" x-on:click="open = ! open"
                                                    id="{{ "{$individualField}-{$this->hash}" }}">
                                                <label for="{{ "{$individualField}-{$this->hash}" }}">{{ __('Add') }}
                                                    {{ __($this->fields[$individualField]['label']) }}</label><br>
                                                <div x-show="open">
                                                    @livewire('backend.child-form-component', ['model' =>
                                                    $this->fields[$individualField]['model'], 'fieldName' =>
                                                    $individualField,
                                                    'heirarchy'=> 'slave'],
                                                    key(md5($individualField) . $this->refreshForm))
                                                </div>
                                            </div>
                                        @else
                                            @livewire('backend.child-form-component', ['model' =>
                                            $this->fields[$individualField]['model'], 'fieldName' =>
                                            $individualField,
                                            'heirarchy'=> 'slave'],
                                            key(md5($individualField) . $this->refreshForm))
                                        @endif
                                    @break

                                    @case('file')
                                        <div wire:ignore class="dz-wrapper">
                                            <input name="{{ $individualField }}" data-field="{{ $individualField }}"
                                                hidden />
                                            <div class="dropzone dz-{{ $this->hash }} needsclick"
                                                wire:key="{{ $individualField }}-{{ $this->hash }}"
                                                data="dropzone-{{ $individualField }}">
                                                <div class="dz-message needsclick">
                                                    <span class="text">
                                                        <img src="{{ asset('img/upload.png') }}" alt="Camera" />
                                                        {{ __('Drop files here or click to upload.') }}
                                                    </span>
                                                    <span class="plus">+</span>
                                                </div>
                                            </div>
                                        </div>
                                    @break

                                    @default
                                        <input name="{{ $individualField }}" id="{{ $individualField }}"
                                            wire:key="{{ $individualField }}"
                                            type="{{ $this->fields[$individualField]['type'] }}"
                                            class="form-control @error("data.$individualField") is-invalid @enderror
                                        {{ isset($this->fields[$individualField]['class']) ? $this->fields[$individualField]['class'] : '' }}"
                                            {{ true === $this->fields[$individualField]['required'] ? 'required="required"' : '' }}
                                            {{ true === $this->fields[$individualField]['disabled'] ? 'disabled="disabled"' : '' }}
                                            placeholder="@lang($this->fields[$individualField]['label'])"
                                            wire:model.lazy="data.{{ $individualField }}"
                                            data-model="data.{{ $individualField }}" />
                                @endswitch

                                @error("data.$individualField")
                                    <span id="invalid{{ $individualField }}Feedback" class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endpush
    @endforeach

    <div class="tab-content">
        @stack("tabData-{$this->hash}")
    </div>
</div>

@if (env('APP_ENV') === 'local')
    <div class="form-group row">
        <label for="name-0" class="col-md-2 col-form-label">Form Values (Debug Only)</label>
        <div class="col-md-10">
            <code>
                {!! '<pre>' . print_r($this->data, true) . '</pre>' !!}
            </code>
        </div>
    </div>
@endif
