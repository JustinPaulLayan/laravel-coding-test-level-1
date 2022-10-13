@extends('visitor-layout.app')

@section('content')
    <div class="min-h-full bg-white px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
        <div class="mx-auto max-w-max">
            <main class="sm:flex">
                <p class="text-4xl font-bold tracking-tight text-indigo-600 sm:text-5xl">Event</p>
                <div class="sm:ml-6">
                <div class="sm:border-l sm:border-gray-200 sm:pl-6">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{ $event->name }}</h1>
                    <p class="mt-1 text-base text-gray-500">Start At: <span class="font-bold text-gray-700">{{ $event->startAt }}</span></p>
                    <p class="mt-1 text-base text-gray-500">Ends At: <span class="font-bold text-gray-700">{{ $event->endAt }}</span></p>
                </div>
                <div class="mt-10 flex space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                    <a href="{{ route('events') }}" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Back to List</a>
                </div>
                </div>
            </main>
        </div>
    </div>
@endsection