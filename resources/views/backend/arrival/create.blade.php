@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@inject('user', '\App\Domains\Auth\Models\User')

@section('title', __('Create a new Arrival Report'))

@section('content')
    <x-forms.post :action="route('admin.arrival.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create a new Arrival Report')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="asset('/import/Import-Template-Arrival.xlsx')" :text="__('Download Excel Import Template File')" />
                <x-utils.link class="card-header-action" :href="route('admin.arrival.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="alert alert-warning" role="alert">
                    {{ __('kalimati.warn_bulk_update_pricelog') }}
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Entry Date') }}</label>

                    <div class="col-md-10">
                        <input type="date" name="entry_date" class="form-control" value="{{ date('Y-m-d') }}" required="required">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">{{ __('Price Type') }}</label>

                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-btn">
                              <a
                                id="file-manager-input"
                                data-input="file"
                                class="btn btn-primary text-white">
                                <i class="cil-clipboard"></i>  {{ __('Choose File') }}
                              </a>
                            </span>
                            <input id="file" class="form-control" type="text" name="file">
                          </div>
                          <div id="holder-div-for-preview" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create a new Arrival Report')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection

@include('backend.includes.partials.filemanager')

@push('after-scripts')
<script>lfm('file-manager-input', 'file', {prefix: route_prefix});</script>
@endpush
