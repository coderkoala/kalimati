<footer class="c-footer">
    <div>
        <strong>
            @lang('Copyright') &copy; {{ date('Y') }}
            <x-utils.link href="http://kalimatimarket.gov.np" target="_blank" :text="__(appName())" />
        </strong>

        @lang('All Rights Reserved')
    </div>

    <div class="mfs-auto">
        @lang('Powered by')
        <x-utils.link href="https://comptech.com.np" target="_blank" text="Comptech International Pvt. Ltd." />
    </div>
</footer>
