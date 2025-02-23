@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="font-[sans-serif]">
    <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-md w-full">
            <div class="p-8 rounded-2xl bg-white shadow">
                <h2 class="text-gray-800 text-center text-2xl font-bold">Sign in</h2>
                <form class="mt-8 space-y-4" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Email</label>
                        <div class="relative flex items-center">
                            <input name="email" type="text" class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600 @error('email') is-invalid @enderror" placeholder="Enter email" required/>
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Password</label>
                        <div class="relative flex items-center">
                            <input name="password" type="password" class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600 @error('password') is-invalid @enderror" placeholder="Enter password" required/>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                            <label for="remember-me" class="ml-3 block text-sm text-gray-800">Remember me</label>
                        </div>
                        <div class="text-sm">
                            <a href="jajvascript:void(0);" class="text-blue-600 hover:underline font-semibold">Forgot your password?</a>
                        </div>
                    </div>

                    <div class="!mt-8">
                        <button type="submit" class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                            Sign in
                        </button>
                    </div>

                    <p class="text-gray-800 text-sm !mt-8 text-center">Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">Register here</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection