@if (1 < count($this->formLayout))
    @include('livewire.backend.includes.renderer.fields-tabular')
@else
    @include('livewire.backend.includes.renderer.fields-single')
@endif
