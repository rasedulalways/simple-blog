<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        New Post
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Use this form to create a new post.
                                    </p>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="category_id"
                                        class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                                    <select id="category_id" name="category_id"
                                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $data)
                                            <option value="{{ $data->id }}">
                                        {{ $data->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="text-red-500">
                                        @error('category_id')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select id="status" name="status"
                                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">Select Status</option>
                                        <option value="active"> Active </option>
                                        <option value="inactive"> Inactive </option>

                                    </select>
                                    <div class="text-red-500">
                                        @error('status')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Post Title<span class="text-red-500">*</span></label>
                                    <input class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        id="title" name="title" type="text" placeholder="Enter Post Title">
                                    <div class="text-red-500">
                                        @error('title')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="content" class="block text-sm font-medium text-gray-700">Post Description<span class="text-red-500">*</span></label>
                                    <textarea name="content" id="content" cols="30" rows="10"
                                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm d-flex" ></textarea>
                                    <div class="text-red-500">
                                        @error('content')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="tag_id" class="block text-sm font-medium text-gray-700">Tags</label>
                                    <select id="tag_id" name="tag_id[]" multiple class="mt-1 w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">Select Tags</option>
                                        @foreach ($all_tags as $item)
                                            <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                        @endforeach

                                    </select>
                                    <div class="text-red-500">
                                        @error('tag_id')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="thumbnail" class="block text-sm font-medium text-gray-700">Image</label>
                                    <input type="file" name="thumbnail" id="thumbnail"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                    <div class="text-red-500">
                                        @error('thumbnail')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 mt-4">
                            <button type="submit" class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
