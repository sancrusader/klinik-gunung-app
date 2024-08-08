<x-layout>
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <!-- Card -->
        <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800">
            <div class="w-full p-6 sm:p-8">
                <h2 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">
                    Buat Antrian
                </h2>
                <p class="text-base font-normal text-gray-500 dark:text-gray-400">

                </p>
                <form class="mt-8 space-y-6" action="{{ route('screening-offline.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                            Name</label>
                        <input type="full_name" name="full_name" id="full_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Your Name" required>
                    </div>
                    <button type="submit"
                        class="w-full px-5 py-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Daftar</button>
                </form>
            </div>
        </div>
    </div>
    </main>
</x-layout>
