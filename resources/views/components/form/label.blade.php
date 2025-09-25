@props(['value'])

<label {{ $attributes->merge(['class' => 'text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>