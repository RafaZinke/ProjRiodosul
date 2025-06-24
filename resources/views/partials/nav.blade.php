<nav class="bg-white shadow p-4 mb-6">
    <a href="{{ route('places.index') }}" class="font-bold">Home</a>
    @auth
        <a href="{{ route('admin.places.index') }}" class="ml-4">Admin</a>
        <form action="{{ route('logout') }}" method="POST" class="inline ml-4">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="ml-4">Login</a>
    @endauth
</nav>
