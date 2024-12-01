@extends('layouts.app')
@section('title', 'Produk')
@section('content')
<div class="text-primary" x-data="{
    products: {{$products->map(fn($item) => [
        'id' => $item->id,
        'name' => $item->name,
        'purchase_price' => $item->purchase_price,
        'selling_price' => $item->selling_price,
        'image' => asset('storage/' . $item->img),
        'category_id' => $item->category_id
    ])->toJson() }},
    selectedCategory: null,
    searchTerm: '',

    get filteredProducts() {
        return this.products.filter(product => {
            const matchCategory = this.selectedCategory === null || product.category_id === this.selectedCategory;
            const matchSearch = this.searchTerm === '' || product.name.toLowerCase().includes(this.searchTerm.toLowerCase());
            return matchCategory && matchSearch;
        });
    },

    setCategory(categoryId) {
        this.selectedCategory = categoryId;
    }
}">
    <div class="flex justify-between gap-4">
        <div class="flex-grow">
            <div class="relative">
                <div class="w-full">
                    <input type="search"
                        x-model="searchTerm"
                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-primary focus:ring-tertiary focus:border-tertiary dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-tertiary"
                        placeholder="Cari item" />
                </div>
                <button type="submit"
                    class="absolute top-0 right-0 p-2.5 text-sm font-medium h-full text-white bg-primary rounded-e-lg border border-primary hover:bg-primary focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-primary dark:focus:ring-primary">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </div>
        </div>

        <div class="flex justify-end mb-4 items-center">
            <a href="{{ route('product.create') }}"
                class="bg-primary hover:bg-secondary py-2 px-3 rounded-lg text-white font-medium flex sm:text-base text-sm items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16px" class="fill-white mr-2 py-1"
                    viewBox="0 0 448 512">
                    <path
                        d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z" />
                </svg>
                Tambah
            </a>
        </div>
    </div>

    <!-- Product Categories -->
    <div class="mb-4 overflow-x-auto">
        <div class="sm:justify-normal flex gap-1 sm:gap-3">
            <button
                @click="setCategory(null)"
                :class="{'bg-primary': selectedCategory === null, 'bg-secondary': selectedCategory !== null}"
                class="text-white rounded-full py-2 px-4 sm:p-3 hover:bg-primary transition-colors">
                <h6 class="text-sm sm:text-base">Semua</h6>
            </button>
            @foreach ($categories as $category)
            <button
                @click="setCategory({{ $category->id }})"
                :class="{'bg-primary': selectedCategory === {{ $category->id }}, 'bg-secondary': selectedCategory !== {{ $category->id }}}"
                class="text-white rounded-full py-2 px-4 sm:p-3 hover:bg-primary transition-colors">
                <h6 class="text-sm sm:text-base">{{ $category->name }}</h6>
            </button>
            @endforeach
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-2">
        <template x-for="product in filteredProducts" :key="product.id">
            <div class="p-4 bg-white rounded-xl shadow items-center flex justify-between">
                <div class="flex gap-2 items-center w-full">
                    <div class="w-full">
                        <div class="text-center flex flex-col gap-1">
                            <img :src="product.image"
                                :alt="product.name"
                                class="w-12 h-12 sm:h-16 sm:w-16 rounded-xl mx-auto">
                            <h2 class="text-xs sm:text-base font-medium dark:text-white" x-text="product.name"></h2>
                            <h2 class="text-[10px] sm:text-xs font-medium dark:text-white">
                                <span x-text="product.purchase_price"></span> | <span x-text="product.selling_price"></span>
                            </h2>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="w-full">
                            <a :href="'/products/' + product.id + '/edit'" class="">
                                <button class="text-white font-bold w-full p-3 bg-yellow-400 rounded-xl hover:bg-yellow-300 my-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" class="w-3 h-3 md:w-6 md:h-6 mx-auto">
                                        <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                    </svg>
                                </button>
                            </a>
                        </div>
                        <div class="w-full">
                            <button :data-modal-target="'popup-modal-' + product.id" :data-modal-toggle="'popup-modal-' + product.id"
                                class="text-white font-bold w-full p-3 bg-red-700 hover:bg-red-600 rounded-xl" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" class="w-3 h-3 md:w-6 md:h-6 mx-auto">
                                    <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div :id="'popup-modal-' + product.id" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="fixed inset-0 bg-black opacity-50 z-40"></div>
                        <div class="relative p-4 w-full max-w-md max-h-full z-50">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 end-2.5 text-primary bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" :data-modal-hide="'popup-modal-' + product.id">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-primary w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                    <h3 class="mb-5 text-lg font-normal text-primary dark:text-primary">Yakin ingin mengapus product <span x-text="product.name"></h3>
                                    <form :action="'/products/' + product.id" method="post" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-500 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Ya, Saya yakin
                                        </button>
                                    </form>
                                    <button :data-modal-hide="'popup-modal-' + product.id" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-secondary focus:outline-none bg-white rounded-lg border border-secondary hover:bg-secondary hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-primary dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        Tidak, Kembali
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
@endsection
