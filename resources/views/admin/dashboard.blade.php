<h1>halaman admin</h1>
<p>Selamat datang di dashboard admin.</p>
<p>Di sini Anda dapat mengelola konten dan pengaturan situs.</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>