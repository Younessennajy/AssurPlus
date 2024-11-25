<div>
    <form wire:submit.prevent="submitMapping">
        <h3 class="text-xl font-semibold mb-4">Map Columns</h3>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th>Column</th>
                    <th>Excel Headers</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($b2bColumns as $column)
                    <tr>
                        <td>{{ $column }}</td>
                        <td>
                            <select wire:model="mappings.{{ $column }}" class="border rounded-md">
                                <option value="">Select Excel Header</option>
                                @foreach ($excelHeaders as $index => $header)
                                    <option value="{{ $index }}">{{ $header }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mt-4">
            Submit Mapping
        </button>
    </form>
</div>
