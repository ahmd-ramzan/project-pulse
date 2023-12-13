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
                    <div class="bg-white rounded-lg shadow p-5" style="height:200px;box-sizing: content-box;">

                        <h3 class="font-normal text-xl mb-6 py-4 -ml-5 mb-3 border-l-4 border-blue-400 pl-4">

                            <a href="{{ $project->path() }}" class="text-black no-underline">{{ $project->title }}</a>

                        </h3>

                        <div class="text-gray-500">{{ Str::limit($project->description, 70) }}</div>

                    </div>
                </div>
            @empty
                <div>No project yet.</div>
            @endforelse
        </main>
    </div>
</x-app-layout>
