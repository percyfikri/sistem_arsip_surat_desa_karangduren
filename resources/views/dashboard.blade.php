<h1>halo dasboard</h1>

<form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
    @csrf
    <button type="submit">Logout</button>
</form>