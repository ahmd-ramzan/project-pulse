<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Project
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="/projects" class="mt-6 space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="title" value="Title"/>
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" />
                            {{--<x-input-error class="mt-2" :messages="$errors->get('name')"/>--}}
                        </div>

                        <div>
                            <x-input-label for="description" value="Description"/>
                            <textarea id="description" name="description" class="mt-1 block w-full"></textarea>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Save</x-primary-button>
                            <x-primary-link href="/projects">Cancel</x-primary-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
