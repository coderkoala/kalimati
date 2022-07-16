<div>
    <div wire:ignore.self class="modal modal-{{ $this->hash }} modal-fix-padding fade {{ $this->modalName }}"
        role="dialog" aria-labelledby="{{ $this->model->getCanonicalName() }} {{ __('Data Form') }}" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
        <div class="modal-dialog modal-xp" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $this->model->getCanonicalName() }} {{ __('Data Form') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
                <div class="modal-body">
                    @include('livewire.backend.includes.fields')
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn btn-outline-success" type="button"
                        wire:click="submit">@lang('Save')</button>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.backend.includes.scripts', ['modalName' => $this->modalName])

    @push('after-scripts')
        <script>
            window.addEventListener('reset-fields', () => {
                let selector = '.dz-{{ $this->hash }}';
                if ($(selector).length) {
                    window.Dropzone
                        .forElement('.dz-{{ $this->hash }}')
                        .removeAllFiles();
                }
                $('.modal-{{ $this->hash }}').modal('hide');
            });
        </script>
    @endpush
</div>
