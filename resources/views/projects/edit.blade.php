<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Project
        </h2>
    </x-slot>

    <form method="post" action="{{ $project->path() }}" class="mt-6 space-y-6">
        @method('PATCH')
        @include('projects.form', [
        'buttonText' => 'Update Project'
        ])
    </form>

</x-app-layout>
