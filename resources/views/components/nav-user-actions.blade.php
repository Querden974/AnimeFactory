<div class="poppup">

    <h1 class="text-center py-2 mb-2 text-xl font-bold">{{ auth()->user()->name}}</h1>
    <div  class="flex flex-col gap-2 justify-center items-center">
        <a href='{{ route('auth.disconnect') }}' class="btn w-full">Profil</a>
        <a href='{{ route('auth.disconnect') }}' class="btn btn-error w-full">Disconect</a>
    </div>
</div>
