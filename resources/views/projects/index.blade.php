<x-app-layout>
    <x-slot name="header">
       <div class="flex items-center">
           <h2 class="mr-auto font-semibold text-xl text-gray-800 leading-tight">
               Projects
           </h2>
           <x-primary-link href="/projects/create">New Project</x-primary-link>
       </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <ul>
                @forelse($projects as $project)
                    <li>
                        <a href="{{ $project->path() }}">{{ $project->title }}</a>
                    </li>
                @empty
                    <li>No projects yet</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
