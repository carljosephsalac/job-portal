@extends('layouts.app')

@section('content')
    <x-navbar />
    <x-sidebar />

    <main class="flex flex-col items-center justify-center flex-grow px-3 py-3 bg-gray-100 pt-36 sm:py-0 dark:bg-gray-900">
        <div class="w-full lg:max-w-screen-2xl rounded-lg shadow-md relative min-h-screen p-7">
            @if (session('success'))
                <div class="flex justify-center">
                    <x-alert-success>{{ session('success') }}</x-alert-success>
                </div>
            @endif
            @if (auth()->user()->type === 'employer')
                <a href="{{ route('job-portals.create') }}"
                    class="text-white mb-5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white me-2" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                            clip-rule="evenodd" />
                    </svg>
                    Create a job post
                </a>
            @endif
            <div class="grid grid-cols-3 gap-5 min-h-full">
                @foreach ($jobPosts as $jobPost)
                    <x-card :jobPost="$jobPost" />
                @endforeach
            </div>
        </div>
    </main>
@endsection
