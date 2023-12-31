<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Let's start with something new
        </h2>
    </x-slot>

    <form method="post" action="/projects" class="mt-6 space-y-6">
        @include('projects.form', [
        'project' => new \App\Models\Project(),
        'buttonText' => 'Create Project'
        ])
    </form>

</x-app-layout>
