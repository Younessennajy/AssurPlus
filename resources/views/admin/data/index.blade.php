<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg flex">
                <!-- Sidebar -->
                @include('admin.layouts.sidebar')
                <div class="flex justify-between  space-x-2">
                    <div class="relative">
                        <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
                        <svg class="w-5 h-5 text-gray-500 absolute left-3 top-1/2 transform -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 017 7m0 0a7 7 0 11-14 0 7 7 0 0114 0zm-4 7l4 4" />
                        </svg>
                    </div>
                    
                    <div class="space-x-4">
                            <button 
                                onclick="window.location.href='{{ route('import.show') }}'"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Import
                            </button>
        
                            <button 
                                onclick="window.location.href='{{ route('export.show') }}'"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Export
                            </button>
                    </div>
                </div>
                <main>
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <button class="btn btn-primary" onclick="showData('b2c')">B2C Data</button>
            </div>
            <div class="col-md-6">
                <select class="form-select" id="countrySelect" onchange="getDataByCountry()">
                    <option value="">Select Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
                </main>
            </div>
        </div>
    </div>

</x-app-layout>

