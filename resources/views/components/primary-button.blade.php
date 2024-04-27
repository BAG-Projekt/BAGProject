<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-block w-50 mx-auto']) }}>
    {{ $slot }}
</button>
