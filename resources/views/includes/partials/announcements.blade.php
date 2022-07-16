@if(isset($announcements) && $announcements->count())
    @foreach($announcements as $announcement)
        <x-utils.alert :type="$announcement->type" :dismissable="false">
            {{ (new \Illuminate\Support\HtmlString($announcement->message)) }}
        </x-utils.alert>
    @endforeach
@endif
