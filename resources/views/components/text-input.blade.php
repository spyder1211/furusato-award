@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'px-4 py-3 text-base border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-lg shadow-sm']) }}>
