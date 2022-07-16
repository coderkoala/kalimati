@extends('backend.layouts.app')

@section('title', __('Menu Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Menu Management')
        </x-slot>

        @if ($logged_in_user->can('admin.articles.create'))
            <x-slot name="headerActions">
                <x-utils.link icon="c-icon cil-plus" class="card-header-action" :href="route('admin.articles.create')" :text="__('Create a new Article')" />
            </x-slot>
        @endif

        <x-slot name="body">
            <div class="input-group mb-3">
                <select class="custom-select" id="inputGroupAddMenu">
                    <option selected disabled>{{ __('Select page you wish to add to the menu') }}</option>
                    @foreach (\App\Models\Backend\Articles::select('id', 'title_en', 'title_np', 'slug')->where('status', 'published')->get() as $row => $tuple)
                        <option value="{{ $row }}" data-value="{{ json_encode($tuple) }}">
                            {{ $tuple->{'title_' . app()->getLocale()} }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button id="appendData" class="input-group-button btn btn-secondary" for="inputGroupAddMenu">{{ __('Add to Menu') }}</button>
                </div>
            </div>
            @if (setting()->get('DATA_MENU', null))
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Page Title(EN)') }}</th>
                            <th scope="col">{{ __('Page Title(NP)') }}</th>
                            <th scope="col">{{ __('Page Slug(EN)') }}</th>
                            <th scope="col">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="sortable" class="sortable-class">
                        @foreach (setting()->get('DATA_MENU') as $key => $tuple)
                            <tr class="ui-state-default">
                                <td data-value="{{ $tuple['title_en'] }}">{{ $tuple['title_en'] }}</td>
                                <td data-value="{{ $tuple['title_np'] }}">{{ $tuple['title_np'] }}</td>
                                <td data-value="{{ $tuple['slug'] }}"><code>{{ $tuple['slug'] }}</code></td>
                                <td data-value="true"><button type="submit" class="btn btn-danger btn-sm"
                                        onclick="jQuery(this).closest('tr').remove();"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Page Title(EN)') }}</th>
                            <th scope="col">{{ __('Page Title(NP)') }}</th>
                            <th scope="col">{{ __('Page Slug(EN)') }}</th>
                            <th scope="col">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody id="sortable" class="sortable-class">
                        @foreach (\App\Models\Backend\Articles::where('status', 'published')->get() as $key => $tuple)
                            <tr class="ui-state-default">
                                <td data-value="{{ $tuple->{'title_en'} }}">{{ $tuple->{'title_en'} }}</td>
                                <td data-value="{{ $tuple->{'title_np'} }}">{{ $tuple->{'title_np'} }}</td>
                                <td data-value="{{ $tuple->slug }}"><code>{{ $tuple->slug }}</code></td>
                                <td data-value="true"><button type="submit" class="btn btn-danger btn-sm"
                                        onclick="jQuery(this).closest('tr').remove();"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </x-slot>
        <x-slot name="footer">
            <button id="saveChanges" class="btn btn-sm btn-primary float-right" type="submit">@lang('Save Changes')</button>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
    <script>
        (function($) {
            $(function() {
                $(".sortable-class").sortable({
                    placeholder: "ui-state-highlight"
                });
                $(".sortable-class").disableSelection();
            });

            $('#appendData').click(function() {
                var data = $(`[value=${$('#inputGroupAddMenu').val() }]`).data('value');
                $('#sortable').append(`<tr class="ui-state-default"><td data-value="${data['title_en']}">${data['title_en']}</td><td data-value="${data['title_np']}">${data['title_np']}</td><td data-value="${data['slug']}"><code>${data['slug']}</code></td><td data-value="true"><button type="submit" class="btn btn-danger btn-sm" onclick="jQuery(this).closest('tr').remove();"><i class="fas fa-trash"></i></button></td></tr>`);
                Swal.fire({
                    title: '{{ __('Menu Element Added') }}',
                    text: '{{ __('Menu element has been added, please save changes for it to take effect.') }}',
                    icon: 'info',
                    confirmButtonText: '{{ __('OK') }}'
                });

            })

            $('#saveChanges').click(function() {
                var data = [];
                jQuery('tr.ui-state-default').each((index, el) => {
                    var element = jQuery(el).children();
                    data.push({
                        'title_en': jQuery(element[0]).data('value'),
                        'title_np': jQuery(element[1]).data('value'),
                        'slug': jQuery(element[2]).data('value')
                    });
                })
                $.ajax({
                    url: '{{ route('admin.updateMenu') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        data: data
                    },
                    success: function(response) {
                        Swal.fire({
                            title: '{{ __('Success') }}',
                            text: '{{ __('Menu updated successfully') }}',
                            icon: 'success',
                            confirmButtonText: '{{ __('OK') }}'
                        }).then(function(){
                            window.location.reload();
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: '{{ __('Error') }}',
                            text: '{{ __('Menu could not be updated') }}',
                            icon: 'error',
                            confirmButtonText: '{{ __('OK') }}'
                        }).then(function(){
                            window.location.reload();
                        });
                    },
                });
            });
        })(jQuery);
    </script>
@endpush
