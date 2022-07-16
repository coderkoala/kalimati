@extends('backend.layouts.app')

@section('title', __('Article Management'))

@inject('user', '\App\Domains\Auth\Models\User')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Article Management')
        </x-slot>

        @if ($logged_in_user->can('admin.articles.create'))
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.articles.create')"
                    :text="__('Create a new Article')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.articles-table />
        </x-slot>
    </x-backend.card>
@endsection
