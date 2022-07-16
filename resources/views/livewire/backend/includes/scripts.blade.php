@push('after-scripts')
    <script data-instance="{{ $this->hash }}" wire:ignore>
        function initializeJavascriptComponents{{ $this->hash }}() {

            let dropzone = $(".dz-{{ $this->hash }}").not('.initialized');
            if (dropzone.length) {
                dropzone.addClass('initialized').dropzone({
                    url: "{{ route('admin.file.upload') }}",
                    addRemoveLinks: true,
                    maxFilesize: 50,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    init: function initalize() {
                        this.on("complete", function(file) {
                            try {
                                let field = $(file.previewElement).closest('div.dz-wrapper').find(
                                    'input').data('field');
                                let fileHash = JSON.parse(file.xhr.response).hash;
                                Livewire.emit(
                                    '{{ $this->listenersAlias['file-uploaded'] }}',
                                    field,
                                    fileHash
                                );
                            } catch (e) {}

                            $(file.previewElement).find('.dz-remove').first()
                                .attr('id', JSON.parse(file.xhr.response).hash)
                                .data('field', $(file.previewElement).closest('div.dz-wrapper').find(
                                    'input').data('field'))
                                .html(
                                    "<span class='mt-3 fa fa-trash text-danger delete-btn' style='font-size: 1.5em'></span>"
                                )
                                .off()
                                .on('click', function(e) {
                                    let $this = $(e.currentTarget);
                                    Livewire.emit(
                                        '{{ $this->listenersAlias['file-removed'] }}',
                                        $this.data('field'),
                                        $this.attr('id')
                                    );
                                    $.ajax({
                                        url: "{{ route('admin.file.delete', '') }}/" +
                                            $this.attr('id'),
                                        type: 'DELETE',
                                        data: {
                                            '_token': '{{ csrf_token() }}',
                                            'hash': $this.attr('id')
                                        }
                                    });
                                });
                        });
                    }
                });
            }

            let select2AreaChanged = $('.select2-{{ $this->hash }}').not('.initialized-{{ $this->hash }}');
            select2AreaChanged.addClass('initialized-{{ $this->hash }}').each(function(k, element) {
                let $this = $(element);
                let route = false;
                let placeholder = $this.data('placeholder') ?
                    $this.data('placeholder') :
                    '{{ __('Select an Option') }}';
                let parameters = {
                    maximumSelectionLength: $this.data('limit'),
                    dataType: 'json',
                    placeholder: placeholder
                };

                if ( '' !== $this.data('api')) {
                    route = $this.data('api');
                    parameters = {
                        minimumInputLength: 2,
                        placeholder: placeholder,
                        ajax: {
                            url: route,
                            dataType: 'json',
                            headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            delay: 250,
                            type: 'POST',
                            data: function (params) {
                                return {
                                    q: params.term,
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: data.items
                                };
                            },
                            cache: true
                        }
                    }
                }

                $this.select2(parameters).on('change', function() {
                    try {
                        Livewire.emit(
                            '{{ $this->listenersAlias['select-changed'] }}',
                            $(this).data('field'),
                            $(this).select2('val')
                        );
                    } catch (e) {}
                });
            });

            let TextAreaChanged = $('.textarea-{{ $this->hash }}').not('.initialized');
            TextAreaChanged.addClass('initialized').each(
                function(k, element) {
                    let selector = `#${element.id}`;

                    $(selector).trumbowyg({
                        btns: [
                            ['undo', 'redo'], // Only supported in Blink browsers
                            ['formatting'],
                            ['strong', 'em'],
                            ['link'],
                            ['insertImage'],
                            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                            ['unorderedList', 'orderedList'],
                            ['horizontalRule'],
                        ],
                        autogrowOnEnter: true
                    }).on('tbwblur', function(e) {
                        Livewire.emit(
                            '{{ $this->listenersAlias['text-area-changed'] }}',
                            $(this).data('field'),
                            $(selector).html()
                        );
                    });
                }
            );
        }

        $(function() {
            function wrapTimeOut{{ $this->hash }}() {
                setTimeout(initializeJavascriptComponents{{ $this->hash }}, 1000);
            }
            $('.boot').on('click', wrapTimeOut{{ $this->hash }});
            setInterval(initializeJavascriptComponents{{ $this->hash }}, 2500);
            initializeJavascriptComponents{{ $this->hash }}();
        });
    </script>
@endpush
