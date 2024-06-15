@extends('dashboard.layouts.main')
@section('container')
    <section class="bg-white border border-gray-200 shadow-lg rounded mb-4 p-4">
        <h2 class="font-semibold text-2xl text-center">Tabel Buku</h2>
    </section>

    @if (session()->has('success'))
        <div id="success-alert"
            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4  max-w-md sm:w-full"
            role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500 cursor-pointer" role="button"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    onclick="document.getElementById('success-alert').style.display='none'">
                    <title>Tutup</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @endif

    <div class="relative p-6 bg-white border border-gray-200 rounded-lg  overflow-x-auto shadow-lg sm:rounded-lg">
        <div
            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div>
                <a href="/dashboard/books/create"
                    class="text-sm font-semibold bg-green-400 text-white rounded-lg px-3 py-2 hover:bg-green-500">Tambah</a>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <form action="/dashboard/books" method="GET">
                    <input type="text" name="search" id="search" value="{{ old('search', request('search')) }}"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search..">
                </form>
            </div>
        </div>
        <div class="w-full text-gray-500 dark:text-gray-400">
            <table class="w-full text-sm text-left rtl:text-right ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>

                        <th scope="col" class="px-6 py-3">
                            author
                        </th>
                       
                        <th scope="col" class="px-6 py-3">
                            ISBN
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Year
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <img class="w-16 h-16 " src="{{ asset('uploads/cover_image/' . $book->cover_image) }}" alt="Cover buku">
                                <div class="ps-3">
                                    <div class="text-base font-semibold"> {{ $book->title }} </div>
                                    {{-- <div class="font-normal text-gray-500">neil.sims@flowbite.com</div> --}}
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ $book->author }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    {{ $book->isbn }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $book->year }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="/dashboard/books/{{ $book->id }}/edit"
                                    class="font-medium text-yellow-300 dark:text-yellow-500 hover:underline">Edit</a>
                                <span> | </span>
                                <form action="/dashboard/books/{{ $book->id }}" method="POST" class="inline" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-xs font-semibold leading-tight text-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $books->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
@endsection
