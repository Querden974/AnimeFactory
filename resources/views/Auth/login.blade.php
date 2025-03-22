@extends('base')
@section('title', 'Login')

@section('content')

<div class="mt-32">
    <div class="mx-auto max-w-screen-xl px-4  sm:px-6 lg:px-8">
        <div class="mx-auto w-fit">



            <form action="{{ route('auth.connect') }}" method="post"
                class="bg-component mb-0 mt-6 space-y-4 rounded-lg p-4 shadow-lg sm:p-6 lg:p-8">
                @csrf
                <h1 class="text-center text-2xl font-bold text-primary sm:text-3xl">Sign in to your account</h1>

                <div>
                    <label for="name" class="sr-only">Pseudo</label>

                    <div class="flex items-center gap-2 border border-gray-600 rounded px-2 py-1 focus-within:border-primary divide-x divide-gray-600 w-full">
                        <!-- Label -->
                        <label class="text-gray-400 w-26 pr-2">Username</label>

                        <!-- Input -->
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="outline-none w-full px-1 bg-transparent"
                            placeholder="Enter Username"
                        />

                        <!-- Icon (like a button maybe?) -->

                    </div>
                </div>

                <div>
                    <label for="password" class="sr-only">Password</label>

                    <div class="flex items-center gap-2 border border-gray-600 rounded px-2 py-1 focus-within:border-primary divide-x divide-gray-600 w-full">
                        <!-- Label -->
                        <label class="text-gray-400 w-30 pr-2">Password</label>

                        <!-- Input -->
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="outline-none w-full px-1 bg-transparent"
                            placeholder="Enter Username"
                        />

                        <!-- Icon (like a button maybe?) -->
                        <button type="button" id="password-visibility" class="cursor-pointer line text-gray-500 hover:text-primary">
                            🔒
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="block w-full rounded-lg bg-primary px-5 py-3 text-sm font-medium text-background">
                    Log in
                </button>

                <p class="text-center text-sm text-gray-200">
                    No account?
                    <a class="underline" href="/register">Sign up</a>
                </p>
            </form>
        </div>
    </div>
</div>

<script>
    const password_visibility = document.getElementById('password-visibility');
    const password = document.getElementById('password');
    password_visibility.addEventListener('click', function() {
        if (password.type === 'password') {
            password.type = 'text';
            password_visibility.innerText = `👀`;
        } else {
            password.type = 'password';
            password_visibility.innerText= `🔒`;
        }
    });
</script>
@endsection
