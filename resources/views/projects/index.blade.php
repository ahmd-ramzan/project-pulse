<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="mr-auto font-semibold text-xl text-gray-800 leading-tight">
                Projects
            </h2>
            <x-primary-link href="/projects/create">New Project</x-primary-link>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <main class="lg:flex lg:flex-wrap -mx-3">
            @forelse($projects as $project)
                <div class="lg:w-1/3 px-3 pb-6">
                    @include('projects.card')
                </div>
            @empty
                <div>No project yet.</div>
            @endforelse
        </main>
    </div>
</x-app-layout>
