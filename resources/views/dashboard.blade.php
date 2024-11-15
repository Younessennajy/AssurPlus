<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between  space-x-2">
            <div class="relative">
                <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
                <svg class="w-5 h-5 text-gray-500 absolute left-3 top-1/2 transform -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a7 7 0 017 7m0 0a7 7 0 11-14 0 7 7 0 0114 0zm-4 7l4 4" />
                </svg>
            </div>
            
            <div class="space-x-4">
                @if(auth()->user()->can_import)
                    <button 
                        onclick="window.location.href='{{ route('import.show') }}'"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Import
                    </button>
                @endif

                @if(auth()->user()->can_export)
                    <button 
                        onclick="window.location.href='{{ route('export.show') }}'"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Export
                    </button>
                @endif

                @if(!auth()->user()->can_import && !auth()->user()->can_export)
                    <p class="text-gray-500 italic">You don't have any import/export permissions.</p>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                <!-- Main Content -->
                <div class="p-6 text-gray-900 w-3/4">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
