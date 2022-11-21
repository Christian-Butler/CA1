<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Players') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-xl container mx-auto rounded-2 md:pt-6 md:pb-6 md:pl-3 md:pr-3 width: 0.625rem; height: 0.375rem;">
            {{-- <x-alert-success>
                {{ session('success') }}
            </x-alert-success> --}}
            <div class="flex">
                <p class="opacity-70">
                    <strong>Created at: </strong> {{ $player->created_at->diffForHumans()}}
                </p>

                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{ $player->updated_at->diffForHumans()}}
                </p>

                <a href="{{ route('players.edit', $player->id)}}" class="btn-link ml-6 pl-6 d-inline-flex vertical-align: middle;">Edit Note</a>

                <form action="{{ route('players.destroy', $player) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" fonclick="return confirm('Are you sure you wish to delete this player')"> Delete Note</button>
                </form>

            </div>
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                    </h2>
                    <p class="mt-2">
                        {{ $player->first_name }}
                    </p>

                    <p>
                        {{$player->last_name}}
                    </p>

                    <p>
                        {{$player->player_number}}
                    </p>

                    <p>
                        {{$player->dob}}
                    </p>

                    <img src="{{asset('storage/images/' . $player->img) }}" alt="player image">

                    <p></p>
                </div>
        </div>
    </div>
</x-app-layout>