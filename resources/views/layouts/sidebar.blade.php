<aside class="w-64 bg-white shadow-sm">
    <nav class="p-4 space-y-2">
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-4 py-2 rounded-md {{ request()->routeIs('dashboard') ? 'bg-gray-200' : 'hover:bg-gray-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            Dashboard
        </a>
        
        <div class="relative">
            <button onclick="toggleDataMenu()" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-100 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                </svg>
                Pays
            </button>
            <div id="dataMenu" class="hidden bg-white shadow-md rounded-md mt-2 w-full">
                @foreach($pays as $country)
                <div class="py-2 px-4 hover:bg-gray-50">
                    <div class="flex items-center space-x-2 mb-2 cursor-pointer" onclick="toggleCountryOptions('{{ $country->name }}')">
                        <img src="{{ asset('images/countries/' . strtolower($country->name) . '.png') }}" 
                             alt="{{ $country->name }}" 
                             class="w-6 h-6">
                    </div>
                    <div id="options-{{ $country->name }}" class="hidden space-x-2 ml-8">
                        <a href="{{ route('pays.b2b', ['pays' => $country->name]) }}"
                           class="text-sm px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            B2B
                        </a>
                        <a href="{{ route('pays.b2c', ['pays' => $country->name]) }}"
                           class="text-sm px-3 py-1 bg-green-500 text-white rounded-md hover:bg-green-600">
                            B2C
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div> 

    </nav>
</aside>

<script>
    function toggleDataMenu() {
        const menu = document.getElementById('dataMenu');
        menu.classList.toggle('hidden');
    }

    function toggleCountryOptions(countryName) {
        const options = document.getElementById('options-' + countryName);
        if (options.classList.contains('hidden')) {
            document.querySelectorAll('[id^="options-"]').forEach(el => {
                el.classList.add('hidden');
            });
            options.classList.remove('hidden');
        } else {
            options.classList.add('hidden');
        }
    }
</script>