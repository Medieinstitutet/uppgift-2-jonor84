<h1>Välkommen till min Laravel-applikation</h1>

@guest
    <p>Du är inte inloggad. Logga in för att fortsätta.</p>
    <a href="{{ route('login') }}">Logga in här</a>
@else
    <p>Du är inloggad som {{ Auth::user()->name }}</p>
    <a href="{{ route('logout') }}">Logga ut</a>
@endguest