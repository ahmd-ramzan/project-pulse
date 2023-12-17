@csrf
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">

                <div>
                    <x-input-label for="title" value="Title"/>
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                  value="{{ $project->title }}"/>
                    {{--<x-input-error class="mt-2" :messages="$errors->get('name')"/>--}}
                </div>

                <div>
                    <x-input-label for="description" value="Description"/>
                    <textarea id="description" name="description"
                              class="mt-1 block w-full">{{ $project->description }}</textarea>
                </div>

                <div class="flex items-center gap-4 mt-4">
                    <x-primary-button>{{ $buttonText }}</x-primary-button>
                    <a href="{{ $project->path() }}">Cancel</a>
                </div>
            </div>
            @if($errors->any())
                <div class="field mt-6">
                    @foreach($errors->all() as $error)
                        <li class="text-sm text-red-500">{{ $error }}</li>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
