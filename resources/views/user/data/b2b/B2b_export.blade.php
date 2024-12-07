@if(auth()->user()->can_export)
<form action="{{ route('export', ['pays' => $pays->name, 'type' => $type]) }}" 
      method="POST" 
      class="mt-4 md:mt-0">
    @csrf
    <div class="flex flex-col md:flex-row gap-4">
        <div class="relative">
            <select name="format" 
                id="export_format" 
                class="bg-white/10 border border-white/20 text-white rounded-lg px-7 py-2 appearance-none w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-white/50">
                <option value="xlsx" class="text-gray-900">Excel (XLSX)</option>
                <option value="csv" class="text-gray-900">CSV</option>
                <option value="txt" class="text-gray-900">TXT (DOS)</option>
            </select>
            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
        <button type="submit" 
                class="inline-flex items-center px-6 py-2 bg-white text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200 font-semibold">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Exporter
        </button>
    </div>
</form>
@endif