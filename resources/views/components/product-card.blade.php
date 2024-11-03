<button class="rounded-lg" x-on:click="product.quantity++">
    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-secondary transition duration-300 hover:text-white dark:hover:bg-gray-700 cursor-pointer">
        <div class="flex items-center py-4 px-2 md:px-4 justify-start gap-2">
            <img class="w-14 h-14 rounded-xl" src="{{ url('/images/makanan/sate-puyuh.png') }}"
                alt="Bonnie image" />
                <div>
                    <h5 class="text-sm md:text-xl font-medium dark:text-white">Nasi Kucing</h5>
                    <span class="text-xs md:text-sm dark:text-gray-400">Rp 3.000</span>
                </div>
        </div>
    </div>
</button>
