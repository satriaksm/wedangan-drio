@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="text-primary" x-data="{
    users: {{$users->map(fn($item) => [
        'id' => $item->id,
        'name' => $item->name,
        'role' => $item->role,
        'image' => asset('storage/' . $item->img),
    ])->toJson() }},
    selectedCategory: null,
    searchTerm: '',

    get filteredusers() {
        return this.users.filter(user => {
            const matchCategory = this.selectedCategory === null || user.category_id === this.selectedCategory;
            const matchSearch = this.searchTerm === '' || user.name.toLowerCase().includes(this.searchTerm.toLowerCase());
            return matchCategory && matchSearch;
        });
    },

    setCategory(categoryId) {
        this.selectedCategory = categoryId;
    }
}">
    <div class="flex justify-end gap-4">
        <div class="flex justify-end mb-4 items-center">
            <a href="{{ route('user.create') }}"
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

    <!-- User Grid -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6 gap-2">
        <template x-for="user in filteredusers" :key="user.id">
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-end px-4 pt-4">
                </div>
                <div class="flex flex-col items-center pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg" :src="user.image" :alt="user.name"/>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white" x-text="user.name"></h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400" x-text="user.role"></span>
                    <div class="flex mt-2 md:mt-4 gap-2">
                        <a :href="'/users/' + user.id + '/edit'"
                           class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                           Edit
                        </a>
                        <button :data-modal-target="'popup-modal-' + user.id" :data-modal-toggle="'popup-modal-' + user.id"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" class="w-4 h-4">
                                <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                            <!-- Delete Modal -->
            <div :id="'popup-modal-' + user.id" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="fixed inset-0 bg-black opacity-50 z-40"></div>
                <div class="relative p-4 w-full max-w-md max-h-full z-50">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 end-2.5 text-primary bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" :data-modal-hide="'popup-modal-' + user.id">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-primary w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-primary dark:text-primary">Are you sure you want to delete this user?</h3>
                            <form :action="'/users/' + user.id" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-red-600 hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-500 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                    Yes, I'm sure
                                </button>
                            </form>
                            <button :data-modal-hide="'popup-modal-' + user.id" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-secondary focus:outline-none bg-white rounded-lg border border-secondary hover:bg-secondary hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-primary dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                No, cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            </div>


        </template>
    </div>
</div>
@endsection
