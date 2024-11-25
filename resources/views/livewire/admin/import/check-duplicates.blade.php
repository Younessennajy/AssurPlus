<div>
    <h3 class="text-xl font-semibold mb-4">Duplicate Check</h3>
    <p>Total Records: {{ $totalRecords }}</p>
    <p>Duplicates Found: {{ count($duplicates) }}</p>
    <ul>
        @foreach ($duplicates as $phone => $count)
            <li>{{ $phone }} appears {{ $count }} times</li>
        @endforeach
    </ul>
</div>
