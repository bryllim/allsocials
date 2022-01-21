@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <section>
            <a href="{{ url('/home') }}" class="mb-2 text-sm text-indigo-600 hover:text-indigo-900">
                <span class="inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                    </svg>
                    <span class="ml-2">Go Back</span>
                </span>
            </a>
            <h1 class="mb-5 text-3xl">Add a new social link</h1>
        </section>

        <section class="my-5">
            <form action="#">
                <label for="label" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                    Label
                </label>
                <input id="label" type="text" class="form-input w-full" name="label" placeholder="Ex. Facebook, Instagram, etc." required>
                <label for="url" class="block text-gray-700 text-sm font-bold mt-4 mb-2 sm:mb-4">
                    URL
                </label>
                <input id="url" type="text" class="form-input w-full" name="label" placeholder="Ex. instagram.com/username" required>
                <button type="submit" class="mt-5 mb-5 flex bg-indigo-500 rounded font-bold text-white text-center px-3 py-2 transition duration-300 ease-in-out hover:bg-indigo-600">
                    <span>Add Link</span>
                </button>
            </form>
        </section>

    </div>
</main>
@endsection