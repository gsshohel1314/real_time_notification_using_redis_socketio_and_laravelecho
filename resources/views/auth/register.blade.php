@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="font-[sans-serif]">
    <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">
        <div class="max-w-md w-full">
            <div class="p-8 rounded-2xl bg-white shadow">
                <h2 class="text-gray-800 text-center text-2xl font-bold">Sign up</h2>
                <form class="mt-8 space-y-4" action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Name</label>
                        <div class="relative flex items-center">
                            <input name="name" type="text" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Enter name" @error('name') is-invalid @enderror"/>
                        </div>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Email</label>
                        <div class="relative flex items-center">
                            <input name="email" type="text" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Enter email" @error('email') is-invalid @enderror"/>
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Password</label>
                        <div class="relative flex items-center">
                            <input name="password" type="password" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Enter password" @error('password') is-invalid @enderror"/>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Confirm Password</label>
                        <div class="relative flex items-center">
                            <input name="password_confirmation" type="password" required class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Enter confirm password"/>
                        </div>
                    </div>

                    <div class="!mt-8">
                        <button type="submit" class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                            Sign up
                        </button>
                    </div>

                    <p class="text-gray-800 text-sm !mt-8 text-center">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline ml-1 whitespace-nowrap font-semibold">Login here</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection