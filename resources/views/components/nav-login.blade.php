<div class="poppup">
    <h1 class="text-center py-2 text-xl font-bold">Log-In</h1>
    <form action="{{ route('auth.connect') }}" method="post"
        class="bg-component space-y-2 rounded-lg shadow-lg px-2 ">
        @csrf
        <div>
            <label for="name" class="sr-only">Pseudo</label>

            <div class="customInput">
                <!-- Label -->
                <label class="text-gray-400 pr-2">😊</label>

                <!-- Input -->
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="outline-none w-full px-1 bg-transparent"
                    placeholder="Enter Username"
                    autocomplete="off"
                />
            </div>
        </div>

        <div>
            <label for="password" class="sr-only">Password</label>

            <div class="customInput">
                <!-- Label -->
                <label class="text-gray-400 pr-2">🔒</label>

                <!-- Input -->
                <input
                    type="password"
                    name="password"
                    class="outline-none w-full px-1 bg-transparent"
                    placeholder="Enter Username"
                />
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
