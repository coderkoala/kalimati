@push('after-scripts')
    <script>
        var route_prefix = "/admin/file-repositary/";
        {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
        $('#lfm').filemanager('file', {
            prefix: route_prefix
        });
        var lfm = function(id, type, options) {
            let button = document.getElementById(id);
            button.addEventListener('click', function() {
                var route_prefix = (options && options.prefix) ? options.prefix : '/admin/file-repositary/';
                var target_input = document.getElementById(button.getAttribute('data-input'));
                var target_preview = document.getElementById(button.getAttribute('data-preview'));
                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                    'width=900,height=600');
                window.SetUrl = function(items) {
                    var file_path = items.map(function(item) {
                        return item.url;
                    }).join(',');
                    target_input.value = file_path;
                    target_input.dispatchEvent(new Event('change'));
                    try {
                        target_preview.innerHtml = '';
                        items.forEach(function(item) {
                            var img = document.createElement('img')
                            img.setAttribute('style', 'height: 5rem')
                            img.setAttribute('src', item.thumb_url)
                            target_preview.appendChild(img);
                        });
                        target_preview.dispatchEvent(new Event('change'));
                    } catch (e) {
                    }
                };
            });
        };


        jQuery(document).ready(function() {
            var lfm = function(options, cb) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/admin/file-repositary/';
                window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                    'width=900,height=600');
                window.SetUrl = cb;
            };
        });
    </script>
@endpush
