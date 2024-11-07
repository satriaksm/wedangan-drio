<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-secondary dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-secondary uppercase tracking-widest hover:bg-primary     dark:hover:bg-white focus:bg-primary    dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-secondary transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
