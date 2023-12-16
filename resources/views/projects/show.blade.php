<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey text-sm font-normal">
                <a href="/projects" class="text-grey text-sm font-normal no-underline">My Projects</a> / {{ $project->title }}
            </p>
            <x-primary-link href="/projects/create" class="button bg-blue">Create project</x-primary-link>
        </div>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <main>
            <div class="lg:flex -mx-3">
                <div class="lg:w-3/4 px-3 mb-6">
                    <div class="mb-6">
                        <!-- Tasks -->
                        <h2 class="text-grey font-normal text-lg mb-3">Tasks</h2>
                        @foreach ($project->tasks as $task)
                            <div class="bg-white rounded-lg shadow p-5 mb-3">
                                <form method="POST" action="{{ $task->path() }}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="flex items-center">
                                        <x-text-input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'border-l-4 border-green-400' : 'border-l-4 border-red-400' }}" />
                                        <input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                        <div class="bg-white rounded-lg shadow p-5 mb-3">
                            <form action="{{ $project->path() . '/tasks' }}" method="POST">
                                @csrf
                                <x-text-input type="text" name="body" placeholder="Add a new task.." class="w-full"/>
                            </form>
                        </div>
                    </div>
                    <div class="mb-6">
                        <!-- General Notes -->
                        <h2 class="text-grey font-normal text-lg mb-3">General Notes</h2>
                        <textarea placeholder="Anytning special you want to make note of ?" class="bg-white rounded-lg shadow p-5 w-full" style="min-height: 200px;">{{ $project->notes }}</textarea>
                    </div>
                </div>
                <div class="lg:w-1/4 px-3">
                    @include('projects.card')
                    <x-primary-link href="/projects" class="mt-4">Go Back</x-primary-link>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
