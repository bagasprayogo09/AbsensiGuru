@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'border border-blue-400 dark:border-blue-600 dark:bg-gray-800 dark:text-gray-200 focus:border-blue-500 dark:focus:border-blue-500 focus:ring focus:ring-blue-300 dark:focus:ring-blue-400 rounded-md shadow-sm transition ease-in-out duration-150']) }}
    placeholder="Masukkan teks di sini..."
    aria-label="Input field"
>
