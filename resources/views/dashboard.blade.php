<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div class="p-6 text-gray-900" >
                    <a style="color:red;padding:20px;text-align:center;font-weight:bold;text-decoration:underline" href="{{route('home')}}">{{ __("Browse Products") }}</a> &nbsp;
                    <a style="color:gray;padding:20px;text-align:center;font-weight:bold;text-decoration:underline" href="{{route('home')}}">{{ __("Orders") }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
