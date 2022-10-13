@extends('visitor-layout.app')

@section('content')
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Create Event</h2>
        </div>
    
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Name</label>
                        <div class="mt-1">
                            <input id="name" name="name" type="text" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                        </div>
                        @error('name')
                            <div class="text-red-500 text-xs mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Start At</label>
                        <div class="mt-1">
                            <input id="startAt" name="startAt" type="datetime-local" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            @error('startAt')
                                <div class="text-red-500 text-xs mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">End At</label>
                        <div class="mt-1">
                            <input id="endAt" name="endAt" type="datetime-local" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            @error('endAt')
                                <div class="text-red-500 text-xs mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
        
                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save Event</button>
                    </div>
                </form>
                <div>
                    <a href="{{ route('events') }}" class="flex w-full justify-center rounded-md border border-transparent bg-white py-2 px-4 text-sm font-medium border-indigo-400 text-indigo-600 shadow-sm hover:bg-indigo-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mt-2">Back to List</a>
                </div>
            </div>
        </div>
    </div>
@endsection