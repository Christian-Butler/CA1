<x-app-layout>
    <head>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 </head>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teams') }}
        </h2>
    </x-slot>

    


    <div class="py-12">
        <div class="max-w-xl container mx-auto rounded-2 md:pt-6 md:pb-6 md:pl-3 md:pr-3 width: 0.625rem; height: 0.375rem;">
            {{-- <x-alert-success>
                {{ session('success') }}
            </x-alert-success> --}}
            {{-- Creates the route link to the player create view page --}}
            <a href="{{ route('admin.teams.create') }}" class="btn-link btn-lg mb-2">Add a Player</a>
            @forelse ($teams as $team)
                <div class="my-6 p-6 row bg-white row border-b border-gray-200 shadow-sm sm:rounded-lg justify-content-center">
                    <h2 class="font-bold text-2xl my-3 py-3 col-sm-6 col-md-6 col-lg-3 col-xl-6">
                        {{-- Creates the route link to the player show view page --}}
                    <a href="{{ route('admin.teams.show', $team->id) }}">{{ $team->id }}</a>
                    </h2>
                    <h3 class="font-bold text-1x1"> <strong> Team Name </strong>
                        {{$team->team_name}}
                    </h3>
                    {{-- pulls and displays the players first name from the database --}}
                    <p class="mt-2">
                        {{ $team->location}}
                    </p>
                     {{-- pulls and displays the players last name from the database --}}
                </div>
                 {{--  Displays the message No players when no players have been created in the database --}}
            @empty
            <p>No Teams found</p>
            @endforelse
            <!-- This line of code adds the pagination for the index page-->
        </div>
    </div>
</x-app-layout>