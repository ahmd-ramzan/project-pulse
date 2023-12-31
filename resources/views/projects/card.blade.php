<div class="bg-white rounded-lg shadow p-5" style="height:200px;box-sizing: content-box;">

    <h3 class="font-normal text-xl mb-6 py-4 -ml-5 mb-3 border-l-4 border-blue-400 pl-4">

        <a href="{{ $project->path() }}" class="text-black no-underline">{{ $project->title }}</a>

    </h3>

    <div class="text-gray-500 mb-4">{{ Str::limit($project->description, 70) }}</div>

    <footer>
        <form method="POST" action="{{ $project->path() }}" class="text-right">
            @method('DELETE')
            @csrf
            <x-primary-button type="submit" class="text-xs">Delete</x-primary-button>
        </form>
    </footer>

</div>
