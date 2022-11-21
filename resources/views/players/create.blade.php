<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Players') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
            {{-- displays an error when the input fields are missing data when creating a player --}}
            

                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg" {{-- authenicates post requests made by the user --}}>
                    @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
                    @endforeach
                    {{-- Inputs and the stores the data in the database that was submitted in the from fields --}}
                    <form action=" {{ route('players.store') }}" method="POST" enctype="multipart/form-data">
                        {{-- authenicates post requests made by the user --}}
                         @csrf 
                        {{-- Displays the input field for creating the first name of the player --}}
                         <x-text-input type="text" 
                         name="first_name" 
                         field="First Name" 
                         placeholder="First Name" 
                         class="w-full"  
                         autocomplete="off"
                         :value="@old('First Name')"></x-text-input>

                         @error('First Name')
                            <div class="text-red-600 text-sm">{{$message}}</div>
                         @enderror
                         {{-- Displays the input field for creating the last name of the player --}}
                         <x-text-input type="text" 
                         name="last_name" 
                         field="Last Name" 
                         placeholder="Last Name" 
                         class="w-full"  
                         autocomplete="off"
                         :value="@old('Last Name')"></x-text-input>

                         @error('Last Name')
                            <div class="text-red-600 text-sm">{{$mesage}}</div>
                         @enderror
                         {{-- Displays the input field for creating the date of birth of the player --}}
                         <x-text-input type="date" 
                         name="dob" 
                         field="Date of Birth" 
                         placeholder="Date of Birth" 
                         class="w-full"  
                         autocomplete="off"
                         :value="@old('Date of Birth')"></x-text-input>

                         @error('Date of Birth')
                            <div class="text-red-600 text-sm">{{$message}}</div>
                         @enderror
                         {{-- Displays the input field for creating the player number of the player --}}
                         <x-text-input type="number" 
                         name="player_number" 
                         field="Player Number" 
                         placeholder="Player Number" 
                         class="w-full"  
                         autocomplete="off"
                         :value="@old('Player Number')"></x-text-input>

                         @error('Player Number')
                            <div class="text-red-600 text-sm">{{$message}}</div>
                         @enderror
                         {{-- Displays the input field for uploading the image of the player --}}
                         <x-file-input
                        type="file"
                        name="img"
                        placeholder="Book"
                        class="w-full mt-6"
                        field="book_image">
                        </x-file-input>

                         
                         
                     
                         <x-primary-button class="mt-6">Save Note</x-primary-button>
                    </form>
     
                </div>
            
                
            </div>
        </div>
    </div>
</x-app-layout>