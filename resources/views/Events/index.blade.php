@extends('visitor-layout.app')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 pt-4">
        @if ($message = Session::get('success'))
            <div class="rounded-md bg-green-50 p-4 mb-2">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <!-- Heroicon name: mini/check-circle -->
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <div class="text-sm text-green-700">
                            <p>{{ $message }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Events</h1>
                <a href="{{ route('externalapi') }}" class="pt-2 inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">External Api Page</a>
            </div>
            <form action="{{ route('events') }}" method="GET" role="search">
                @csrf
                <div class="mx-2">
                    <span class="input-group-btn mt-1">
                        <button class="btn btn-info" type="submit" title="Search event">
                            <span class="fas fa-search"></span>
                        </button>
                    </span>
                    <input type="text" class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" name="name" placeholder="Search event" id="name">
                    <a href="{{ route('events') }}" class=" mt-1">
                        <span>
                            <button class="btn btn-danger" type="button" title="Refresh page">
                                <span class="fas fa-sync-alt"></span>
                            </button>
                        </span>
                    </a>
                </div>
            </form>
            @auth
                <div class="sm:flex-none">
                    <a href="{{ route('event.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add Event</a>
                </div>
            @endauth
        </div>
        <div class="-mx-4 mt-8 overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">Starts At</th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">Ends At</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach ($events as $event)
                        <tr>
                            <td class="w-full max-w-0 py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:w-auto sm:max-w-none sm:pl-6">
                                <a href="{{ route('event.show', $event->id) }}">{{ $event->name }}</a>
                            <dl class="font-normal lg:hidden">
                                <dt class="sr-only">Start at</dt>
                                <dd class="mt-1 truncate text-gray-700">Start at: <b>{{ $event->startAt }}</b></dd>
                                <dt class="sr-only sm:hidden">End at</dt>
                                <dd class="mt-1 truncate text-gray-700 sm:hidden">End at: <b>{{ $event->endAt }}</b></dd>
                            </dl>
                            </td>
                            <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">{{ $event->startAt }}</td>
                            <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">{{ $event->endAt }}</td>
                            <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                @auth
                                    <form action="{{ route('event.destroy',$event->id) }}" method="Post">
                                        <a class="text-indigo-600 hover:text-indigo-900" href="{{ route('event.edit',$event->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                <!-- More people... -->
                </tbody>
            </table>
            <div class="p-2">
                {!! $events->links() !!}
            </div>
        </div>
    </div>
@endsection