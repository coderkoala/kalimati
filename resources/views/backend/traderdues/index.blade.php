@extends('backend.layouts.app')

@section('title', __('Trader Due Report'))

@inject('user', '\App\Domains\Auth\Models\User')

@section('content')
<div x-data="{ showUploadSpace : false }">
    <x-backend.card>
        <x-slot name="header">
            @lang('Trader Due Report')
        </x-slot>

        @if ($logged_in_user->can('admin.traderdues.create'))
            <x-slot name="headerActions">
                @if($logged_in_user->can('admin.traderdues'))
                    <button
                    x-on:click="showUploadSpace = !showUploadSpace"
                    class="card-header-action btn btn-link">
                    <i class="c-icon cil-plus"></i>
                        {{ __('Bulk Upload Trader Due Entry') }}
                    </button>
                @endif
                <button
                onclick="window.location.href='{{ route('admin.traderdues.create') }}'"
                class="card-header-action btn btn-link">
                <i class="c-icon cil-plus"></i>
                    {{ __('Create a new Trader Due Entry') }}
                </button>
            </x-slot>
        @endif

        <x-slot name="body">
            @if($logged_in_user->can('admin.traderdues'))
                <div x-show="showUploadSpace" class='mt-3 mb-5'>
                    <div class="alert alert-warning" role="alert">
                        {{ __('Please keep in mind that when a bulk upload request is made, all prior trader due data is erased before appending the data from your import file!') }}
                    </div>

                    <x-forms.post :action="route('admin.traderdues.upload')">
                            <div class="form-group row">
                                <div class="col">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                        <a
                                            id="file_uploader"
                                            data-input="file"
                                            class="btn btn-primary text-white">
                                            <i class="cil-clipboard"></i>
                                            {{ __('Choose your spreadsheet') }}
                                        </a>
                                        </span>
                                        <input id="file" class="form-control" type="text" name="file" placeholder="{{ __('Keep in mind that accepted file formats are Microsoft Excel spreadsheets(xlx, xlxs)') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" submit="submit">{{ __('Begin updating Trader Dues') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </x-forms.post>
                </div>
            @endif
            <livewire:backend.trader-dues-table />
        </x-slot>
    </x-backend.card>
</div>
@endsection

@include('backend.includes.partials.filemanager')

@push('after-scripts')
    <script>lfm('file_uploader', 'file', {prefix: route_prefix});</script>
@endpush
