<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                @include('admin.layouts.sidebar')
                <main class="p-6 w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($pays as $country)
                            <div 
                                class="relative group border rounded-lg p-4 bg-white shadow hover:shadow-lg transition-all cursor-pointer"
                                onclick="toggleOptions('{{ $country->id }}')">
                                
                                <img 
                                    src="{{ asset('images/countries/' . strtolower($country->name) . '.png') }}" 
                                    alt="{{ $country->name }}" 
                                    class="w-16 h-16 mx-auto mb-4">
                                <p class="text-center font-semibold">+{{ $country->indicatif }}</p>

                                <div 
                                    id="options-{{ $country->id }}" 
                                    class="hidden absolute top-0 left-0 w-full h-full bg-white bg-opacity-90 flex flex-col items-center justify-center rounded-lg shadow-lg">
                                    <a 
                                        href="{{ route('admin.pays.b2b', ['pays' => $country->name]) }}"
                                        class="mb-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        B2B
                                    </a>
                                    <a 
                                        href="{{ route('admin.pays.b2c', ['pays' => $country->name]) }}"
                                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                        B2C
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </main>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    function toggleOptions(countryId) {
        document.querySelectorAll("[id^='options-']").forEach(option => {
            option.classList.add('hidden');
        });

        const options = document.getElementById(`options-${countryId}`);
        if (options) {
            options.classList.toggle('hidden');
        }
    }

</script>
