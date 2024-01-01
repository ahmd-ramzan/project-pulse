<div class="bg-white rounded-lg shadow p-5 flex flex-col mt-3">
    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-400 pl-4">
        Invite a User
    </h3>

    <form method="POST" action="{{ $project->path() . '/invitations' }}">
        @csrf

        <div class="mb-3">
            <x-text-input type="email" name="email" class="border border-grey-light rounded w-full py-2 px-3" placeholder="Email address" />
        </div>

        <x-primary-button type="submit" class="button">Invite</x-primary-button>
    </form>
    @include('errors', ['bag' => 'invitations'])
</div>
