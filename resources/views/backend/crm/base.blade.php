@extends('backend.layouts.app')

@section('title', __("{$data['resourceName']} Management"))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang($data['resourceName']) @lang('Management')
        </x-slot>

        @if ($logged_in_user->can($data['permissions']['create']))
            <x-slot name="headerActions">
                <a role="button" data-toggle="modal" data-target=".{{ Str::slug($data['resourceName'], '-modal-') }}">
                    @lang('Add') <i class="fas fa-plus"></i>
                </a>
                @livewire('backend.form-component', ['model' => $data['model']::class,
                'modalName' => Str::slug($data['resourceName'], '-modal-'), 'modal' => true])
            </x-slot>
        @endif

        <x-slot name="body">

            View table of {{ $data['resourceName'] }} is under construction.
        </x-slot>
    </x-backend.card>
@endsection
