@extends('layouts.app')

@section('content')
    <x-navbar />
    <x-sidebar />

    <main class="flex flex-col items-center justify-center flex-grow px-3 py-3 bg-gray-100 pt-36 sm:py-0 dark:bg-gray-900">
        <div class="w-full lg:max-w-screen-2xl max-h-[600px] rounded-lg shadow-md relative min-h-screen p-7 align-middle">
            @if (session('success'))
                <div class="flex justify-center">
                    <x-alert-success>{{ session('success') }}</x-alert-success>
                </div>
            @endif
            <section class="bg-white dark:bg-gray-900">
                <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">View job post</h2>
                    <div>
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="title">
                                    Job Title
                                </label>
                                <input
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    type="text" name="title" id="title" value="{{ $jobPost->title }}" readonly
                                    placeholder="Type job title" required="">
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="salary">
                                    Salary
                                </label>
                                <input
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    type="number" name="salary" id="salary" value="{{ $jobPost->salary }}" readonly
                                    placeholder="₱20,000" required="">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="type">
                                    Job Type
                                </label>
                                <input
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    type="text" name="type" id="type" value="{{ $jobPost->type }}" readonly
                                    placeholder="Type job type" required="">
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="location">
                                    Location
                                </label>
                                <input
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    type="text" name="location" id="location" value="{{ $jobPost->location }}" readonly
                                    placeholder="Type location" required="">
                            </div>
                            <div class="w-full">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="company">
                                    Company
                                </label>
                                <input
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    type="text" name="company" id="company" value="{{ $jobPost->company }}" readonly
                                    placeholder="Type company" required="">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="description">
                                    Description
                                </label>
                                <textarea
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    id="description" rows="8" name="description" readonly placeholder="Your description here">{{ $jobPost->description }}</textarea>
                            </div>
                        </div>
                        @if (auth()->user()->id === $jobPost->user_id)
                            <div class="flex justify-between">
                                <a class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800"
                                    href="{{ route('job-portals.edit', $jobPost->id) }}">
                                    Edit
                                </a>
                                <form class="inline-block ml-2" action="{{ route('job-portals.destroy', $jobPost->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-white bg-red-600 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
