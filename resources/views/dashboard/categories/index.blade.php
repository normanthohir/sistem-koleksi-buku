@extends('dashboard.layouts.main')
@section('container')
    <section class="bg-white border border-gray-200 shadow-lg rounded mb-4 p-4">
        <h2 class="font-semibold text-2xl text-center">Table Category</h2>
    </section>
    
    
    <div class="relative p-6 bg-white border border-gray-200 rounded-lg  overflow-x-auto shadow-lg sm:rounded-lg">
        <div
            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
            <div>
                <a href=""
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
                <form  method="GET">
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
            
                        <th nscope="col" class="px-6 py-3">
                            Name
                        </th>
                       
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                <div class="ps-3">
                                    <div class="text-base font-semibold"> {{ $category->nama }} </div>
                                </div>
                            </th>
                            
                            <td class="px-6 py-4">
                                <a href=""
                                    class="font-medium text-yellow-300 dark:text-yellow-500 hover:underline">Edit</a>
                                <span> | </span>
                                <form action="" method="POST" class="inline" enctype="multipart/form-data">
                                    
                                    <button type="submit"
                                        class="text-xs font-semibold leading-tight text-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $categories->appends(request()->query())->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

    @endsection    