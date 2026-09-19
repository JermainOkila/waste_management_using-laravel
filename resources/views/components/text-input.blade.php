@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-gray-700 border-gray-600 text-gray-100 placeholder-gray-400 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm']) }}>