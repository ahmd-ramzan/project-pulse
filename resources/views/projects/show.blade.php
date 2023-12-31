<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey text-sm font-normal">
                <a href="/projects" class="text-grey text-sm font-normal no-underline">My Projects</a>
                / {{ $project->title }}
            </p>

            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img
                        src="{{ gravatar_url($member->email) }}"
                        alt="{{ $member->name }}'s avatar"
                        class="rounded-full w-8 mr-2">
                @endforeach

                <img
                    src="{{ gravatar_url($project->owner->email) }}"
                    alt="{{ $project->owner->name }}'s avatar"
                    class="rounded-full w-8 mr-2">
            </div>

            <x-primary-link href="{{ $project->path().'/edit' }}" class="button bg-blue">Edit</x-primary-link>
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
                                        <x-text-input name="body" value="{{ $task->body }}"
                                                      class="w-full {{ $task->completed ? 'border-l-4 border-green-400' : 'border-l-4 border-red-400' }}"/>
                                        <input name="completed" type="checkbox"
                                               class="mx-2"
                                               onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
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
                        <form method="POST" action="{{ $project->path() }}">
                            @csrf
                            @method('PATCH')
                            <h2 class="text-grey font-normal text-lg mb-3">General Notes</h2>
                            <textarea placeholder="Anytning special you want to make note of ?"
                                      name="notes"
                                      class="bg-white rounded-lg shadow p-5 w-full"
                                      style="min-height: 200px;">{{ $project->notes }}</textarea>
                            <x-primary-button type="submit" class="button">Save</x-primary-button>
                        </form>
                    </div>
                </div>
                <div class="lg:w-1/4 px-3">
                    @include('projects.card')
                    @include('projects.activity.card')

                    @can('manage', $project)
                        @include('projects.invite')
                    @endcan
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
