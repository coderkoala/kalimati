@extends('backend.layouts.app')

@section('title', __('Price Log Management'))

@inject('user', '\App\Domains\Auth\Models\User')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Price Log Management')
        </x-slot>


        @if ($logged_in_user->can('admin.pricelog.create'))
            <x-slot name="headerActions">
                <x-utils.link icon="c-icon cil-plus" class="card-header-action" :href="route('admin.pricelog.create')" :text="__('Create a new Price Log')" />
            </x-slot>
        @endif

        <x-slot name="body">
            <div class="alert alert-warning" role="alert">
                {{ __('Please note that the price log edit feature is only for wholesale prices. Retail prices can only be removed and reuploaded. Deleting either prices will affect both.') }}
            </div>
            <livewire:backend.price-table />
        </x-slot>
    </x-backend.card>
@endsection
