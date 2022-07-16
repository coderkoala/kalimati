<form method="put" {{ $attributes->merge(['action' => '#', 'class' => 'form-horizontal']) }}>
    @csrf

    {{ $slot }}
</form>
