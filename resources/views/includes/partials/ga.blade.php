@if (setting()->get('API_GOOGLE_ANALYTICS_V4', false))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting()->get('API_GOOGLE_ANALYTICS_V4') }}" defer>
    </script>
@endif

@if (setting()->get('API_GOOGLE_ANALYTICS', false))
    <script defer>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '{{ setting()->get('API_GOOGLE_ANALYTICS') }}');
    </script>
@endif

@if (setting()->get('API_GOOGLE_RECAPTCHA', false))
    <script async src="https://www.google.com/recaptcha/api.js?render={{ setting()->get('API_GOOGLE_RECAPTCHA') }}" defer>
    </script>
@endif

@if (setting()->get('API_TAWK_KEY', false))
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src =
                'https://embed.tawk.to/{{ setting()->get('API_TAWK_KEY') }}/{{ setting()->get('API_TAWK_WID') }}';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
@endif
