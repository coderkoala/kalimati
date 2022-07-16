<div class="form-horizontal">
    @foreach ($this->fields as $fieldName => $fieldDataTuple)
        @if (!empty($fieldDataTuple['render']))
            <div
                class="form-group row{{ isset($fieldDataTuple['hidden']) && true === $fieldDataTuple['hidden'] ? ' hidden' : '' }}">
                <label for="{{ $fieldName }}"
                    class="col-md-2 col-form-label {{ isset($fieldDataTuple['required']) && true === $fieldDataTuple['required'] ? 'font-weight-bold' : 'font-weight-normal' }}">@lang($fieldDataTuple['label'])</label>
                <div class="col-md-10">
                    @switch($fieldDataTuple['type'])
                        @case('textarea')
                            <div wire:ignore>
                                <div id="{{ $fieldName }}-{{ $this->hash }}"
                                    wire:key="{{ $fieldName }}-{{ $this->hash }}"
                                    class="textarea-{{ $this->hash }} form-control d-block
                                        @error("data.$fieldName") is-invalid @enderror"
                                    data-field="{{ $fieldName }}" style="height:10rem; width: 100%">
                                </div>
                            </div>
                        @break

                        @case('select')
                            <div wire:ignore>
                                <select style="width: 100%" name="{{ $fieldName }}-{{ $this->hash }}"
                                    data-api='{{ isset($fieldDataTuple['route']) ? $fieldDataTuple['route'] : null }}'
                                    id="{{ $fieldName }}-{{ $this->hash }}"
                                    wire:key="{{ $fieldName }}-{{ $this->hash }}"
                                    class="form-control select2-{{ $this->hash }}
                                        @error("data.$fieldName") is-invalid @enderror
                                        d-block {{ isset($fieldDataTuple['class']) ? $fieldDataTuple['class'] : '' }}"
                                    {!! isset($fieldDataTuple['placeholder']) ? " data-placeholder='{$fieldDataTuple['placeholder']}'" : '' !!} {{ true === $fieldDataTuple['disabled'] ? ' disabled' : '' }}
                                    {{ true === $fieldDataTuple['hidden'] ? ' hidden' : '' }}
                                    {{ isset($fieldDataTuple['multiple']['affirm']) && $fieldDataTuple['multiple']['affirm']? " multiple data-limit={$fieldDataTuple['multiple']['limit']}": '' }}
                                    data-field="{{ $fieldName }}">
                                    <option></option>
                                    @if ( !empty($fieldDataTuple['loadOptions']))
                                        @if (is_array($fieldDataTuple['model']))
                                            @foreach ($fieldDataTuple['model'] as $tupleKey => $tupleValue)
                                                <option value="{{ $tupleKey }}">
                                                    {{ empty($fieldDataTuple['showPK']) ? '' : "{$tupleKey}" }}
                                                    @lang($tupleValue)</option>
                                            @endforeach
                                        @else
                                            @foreach ($fieldDataTuple['model']::select('id', 'name')->get() as $tuple)
                                                <option value="{{ $tuple->id }}">
                                                    {{ empty($fieldDataTuple['showPK']) ? '' : "[{$tuple->id}]" }}
                                                    @lang($tuple->name)</option>
                                            @endforeach
                                        @endif
                                    @endif
                                </select>
                            </div>
                        @break

                        @case('checkbox')
                            @if (is_array($fieldDataTuple['model']))
                                @foreach ($fieldDataTuple['model'] as $iterator => $tuple)
                                    <div class="form-check">
                                        <label class="form-check-label"
                                            for="{{ $fieldName }}-{{ $this->hash }}[{{ $iterator }}]">
                                            <input value="{{ $iterator }}" name="{{ $fieldName }}-{{ $this->hash }}"
                                                id="{{ $fieldName }}-{{ $this->hash }}[{{ $iterator }}]"
                                                wire:key="{{ $fieldName }}-{{ $this->hash }}[{{ $iterator }}]"
                                                type="checkbox"
                                                class="form-check-input
                                                    @error("data.$fieldName") is-invalid @enderror
                                                    d-block {{ isset($fieldDataTuple['class']) ? $fieldDataTuple['class'] : '' }}"
                                                {{ true === $fieldDataTuple['disabled'] ? 'disabled' : '' }}
                                                {{ true === $fieldDataTuple['hidden'] ? 'hidden' : '' }}
                                                wire:model.lazy="data.{{ $fieldName }}.{{ $iterator }}"
                                                data-model="data.{{ $fieldName }}.{{ $iterator }}">
                                            @lang($tuple)
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($fieldDataTuple['model']::all() as $iterator => $tuple)
                                    <div class="form-check">
                                        <label class="form-check-label"
                                            for="{{ $fieldName }}-{{ $this->hash }}[{{ $iterator }}]">
                                            <input value="{{ $tuple->id }}" name="{{ $fieldName }}-{{ $this->hash }}"
                                                id="{{ $fieldName }}-{{ $this->hash }}[{{ $iterator }}]"
                                                wire:key="{{ $fieldName }}-{{ $this->hash }}[{{ $iterator }}]"
                                                type="checkbox"
                                                class="form-check-input
                                                    @error("data.$fieldName") is-invalid @enderror
                                                    d-block {{ isset($fieldDataTuple['class']) ? $fieldDataTuple['class'] : '' }}"
                                                {{ true === $fieldDataTuple['disabled'] ? 'disabled' : '' }}
                                                {{ true === $fieldDataTuple['hidden'] ? 'hidden' : '' }}
                                                wire:model.lazy="data.{{ $fieldName }}.{{ $iterator }}"
                                                data-model="data.{{ $fieldName }}.{{ $iterator }}">
                                            @lang($tuple->name)
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        @break

                        @case('radio')
                            @if (is_array($fieldDataTuple['model']))
                                @foreach ($fieldDataTuple['model'] as $iterator => $tuple)
                                    <div class="form-check">
                                        <label class="form-check-label" for="{{ $fieldName }}-{{ $iterator }}">
                                            <input value="{{ $iterator }}" name="{{ $fieldName }}"
                                                id="{{ $fieldName }}-{{ $iterator }}"
                                                wire:key="{{ $fieldName }}-{{ $this->hash }}-{{ $iterator }}"
                                                type="radio"
                                                class="form-check-input
                                                    @error("data.$fieldName") is-invalid @enderror
                                                    d-block {{ isset($fieldDataTuple['class']) ? $fieldDataTuple['class'] : '' }}"
                                                {{ true === $fieldDataTuple['disabled'] ? 'disabled' : '' }}
                                                {{ true === $fieldDataTuple['hidden'] ? 'hidden' : '' }}
                                                wire:model.lazy="data.{{ $fieldName }}"
                                                data-model="data.{{ $fieldName }}">
                                            @lang($tuple)
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($fieldDataTuple['model']::all() as $iterator => $tuple)
                                    <div class="form-check">
                                        <label class="form-check-label" for="{{ $fieldName }}-{{ $iterator }}">
                                            <input value="{{ $tuple->id }}" name="{{ $fieldName }}"
                                                id="{{ $fieldName }}-{{ $iterator }}"
                                                wire:key="{{ $fieldName }}-{{ $this->hash }}-{{ $iterator }}"
                                                type="radio"
                                                class="form-check-input
                                                    @error("data.$fieldName") is-invalid @enderror
                                                    d-block {{ isset($fieldDataTuple['class']) ? $fieldDataTuple['class'] : '' }}"
                                                {{ true === $fieldDataTuple['disabled'] ? 'disabled' : '' }}
                                                {{ true === $fieldDataTuple['hidden'] ? 'hidden' : '' }}
                                                wire:model.lazy="data.{{ $fieldName }}"
                                                data-model="data.{{ $fieldName }}">
                                            @lang($tuple->name)
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        @break

                        @case('bool')
                            <div class="form-check">
                                <label class="form-check-label" for="{{ $fieldName }}">
                                    <input name="{{ $fieldName }}" id="{{ $fieldName }}"
                                        wire:key="{{ $fieldName }}-{{ $this->hash }}" type="checkbox"
                                        class="form-check-input
                                            @error("data.$fieldName") is-invalid @enderror
                                            d-block {{ isset($fieldDataTuple['class']) ? $fieldDataTuple['class'] : '' }}"
                                        {{ true === $fieldDataTuple['disabled'] ? 'disabled' : '' }}
                                        {{ true === $fieldDataTuple['hidden'] ? 'hidden' : '' }}
                                        wire:model.lazy="data.{{ $fieldName }}" data-model="data.{{ $fieldName }}">
                                    @lang($fieldDataTuple['label'])
                                </label>
                            </div>
                        @break

                        @case('form')
                            @if ( isset($fieldDataTuple['table']['columns']))
                                @include('livewire.backend.includes.tables.renderer', ['field' => $fieldName])
                            @endif
                            @if (!empty($fieldDataTuple['required']))
                                @livewire('backend.child-form-component', ['model' =>
                                $fieldDataTuple['model'], 'fieldName' => $fieldName,
                                'heirarchy'=> 'slave'],
                                key(md5($fieldName) . $this->refreshForm))
                            @else
                                <div x-data="{ open: false }">
                                    <input type="checkbox" x-on:click="open = ! open"
                                        id="{{ "{$fieldName}-{$this->hash}" }}">
                                    <label for="{{ "{$fieldName}-{$this->hash}" }}">{{ __('Add') }}
                                        @lang($fieldDataTuple['label'])</label><br>
                                    <div x-show="open">
                                        @livewire('backend.child-form-component', ['model' =>
                                        $fieldDataTuple['model'], 'fieldName' => $fieldName,
                                        'heirarchy'=> 'slave'],
                                        key(md5($fieldName) . $this->refreshForm))
                                    </div>
                                </div>
                            @endif
                        @break

                        @case('file')
                            <div wire:ignore class="dz-wrapper">
                                <input name="{{ $fieldName }}" data-field="{{ $fieldName }}" hidden />
                                <div class="dropzone dz-{{ $this->hash }} needsclick"
                                    wire:key="{{ $fieldName }}-{{ $this->hash }}"
                                    data="dropzone-{{ $fieldName }}">
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
                            <input name="{{ $fieldName }}" id="{{ $fieldName }}" wire:key="{{ $fieldName }}"
                                type="{{ $fieldDataTuple['type'] }}"
                                class="form-control @error("data.$fieldName") is-invalid @enderror
                                    {{ isset($fieldDataTuple['class']) ? $fieldDataTuple['class'] : '' }}"
                                {{ true === $fieldDataTuple['required'] ? 'required="required"' : '' }}
                                {{ true === $fieldDataTuple['disabled'] ? 'disabled="disabled"' : '' }}
                                placeholder="@lang($fieldDataTuple['label'])" wire:model.lazy="data.{{ $fieldName }}"
                                data-model="data.{{ $fieldName }}" />
                    @endswitch

                    @error("data.$fieldName")
                        <span id="invalid{{ $fieldName }}Feedback" class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>
        @endif
    @endforeach
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
