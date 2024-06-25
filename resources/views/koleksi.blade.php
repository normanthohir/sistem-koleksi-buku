@extends('layouts.main')
@section('container')

    {{-- pencaiam search --}}
    <form action="/koleksi" method="GET" class="flex items-center max-w-sm mx-auto my-12">
        <label for="search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                </svg>
            </div>
            <input type="text" name="search" id="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search..." value="{{ old('search', request('search')) }}" />
        </div>
        <button type="submit"
            class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>

    {{-- card koleksi buku --}}
    <section id="blog" class="pt-16 pb-16 bg-slate-100">
        <div class="container">
            <div class="flex flex-wrap ">
                @if ($books->isEmpty())
                    <p class="text-center text-xl font-bold text-red-500  w-full">Data Tidak Ada.</p>
                @else
                    @foreach ($books as $book)
                        <div class="w-full p-3 mt-3 md:w-1/5">
                            <div
                                class="max-w-60 pt-2 bg-white border border-gray-200 rounded-lg shadow-xl dark:bg-gray-800 dark:border-gray-700">
                                <img class="rounded-t-lg w-full h-56 md:h-64"
                                    src="{{ asset('uploads/cover_image/' . $book->cover_image) }}" alt="Book Cover" />
                                <div class="p-5">
                                    <h5 class="mb-1 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                                       <span class="font-bold">Author:</span> {{ $book->author }}
                                    </h5>
                                         {{ $book->title }}</h5>
                                    <h5 class="mb-1 text-lg font-normal tracking-tight text-gray-900 dark:text-white">
                                    <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
                                        <span class="font-bold">ISBN:</span> {{ $book->isbn }}
                                    </p>
                                    <p class="mb-1 font-normal text-gray-700 dark:text-gray-400">
                                        <span class="font-bold">Year:</span> {{ $book->year }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <!-- Pagination links -->
        <div class="mx-32 mt-6">
            {{ $books->links() }}
        </div>
    </section>
@endsection
