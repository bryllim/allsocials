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
            <a href="{{ route('logout') }}" class="mb-2 text-sm text-indigo-600 hover:text-indigo-900 visible sm:invisible" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span class="inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                    </svg>
                    <span class="ml-2">Sign Out</span>
                </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                {{ csrf_field() }}
            </form>
            <h1 class="mb-5 text-3xl truncate">Hello, <span class="font-extrabold">{{ Auth::user()->name }}</span> 👋🏻</h1>
        </section>

        <section class="my-10">
            <a href="{{ route('editprofile') }}" class="border-2 border-indigo-500 rounded-lg font-bold text-indigo-500 px-4 py-3 transition duration-300 ease-in-out hover:bg-indigo-500 hover:text-white mr-6">
                @if(auth()->user()->url)
                allsocials.link/{{ auth()->user()->url }}
                @else
                Set up your main social link
                @endif
            </a>
        </section>

        <section class="flex flex-col break-words bg-white border-1 rounded-md shadow-sm">
            <header class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 sm:py-6 sm:px-8 rounded-t-md">
                Social Links
            </header>
            <div class="w-full p-3">
                <a href="{{ route('addlink') }}" class="mt-3 mb-5 flex bg-indigo-500 rounded font-bold text-white text-center px-3 py-2 transition duration-300 ease-in-out hover:bg-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span class="ml-3">Add social link</span>
                </a>
                @foreach($links as $link)
                <div class="flex flex-row bg-white shadow-sm rounded p-2 my-3">
                    <div class="flex flex-col flex-grow ml-2">
                        <div class="font-bold text-md w-60">{{ $link->label }}</div>
                        <div class="text-xs text-gray-500 w-60">{{ $link->url }}</div>
                    </div>
                    <button onclick="event.preventDefault(); document.getElementById('delete-link{{ $link->id }}').submit();" class="flex items-center justify-center flex-shrink-0 h-7 w-7 rounded-xl bg-indigo-100 text-indigo-500 hover:bg-indigo-500 hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    <form id="delete-link{{ $link->id }}" action="{{ route('deletelink') }}" method="post" class="hidden">
                        @csrf
                        <input type="hidden" name="id" value="{{ $link->id }}">
                    </form>
                </div>
                @endforeach
            </div>
        </section>

    </div>
</main>
@endsection