<x-layout>
    <x-slot:heading>
        Job Listings
    </x-slot:heading>

    <ul>
        @foreach ($jobs as $job)
            <li>
                <a href="/jobs/3">
                    <li><strong>{{ $job['title'] }}:</strong> Pays {{ $job['salary']}} per year.</li>
                </a>
                </li>
            @endforeach
        </ul>
</x-layout>