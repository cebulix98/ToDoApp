<x-guest-layout>
    @vite(['resources/css/welcome.css'])
    <h1>To Do App</h1>
    <div class="panel-row">
        <a href="{{ route('login') }}"><button>Zaloguj się</button></a>
    </div>
    <div class="panel-row">
        <a href="{{ route('register') }}"><button>Zarejestruj się</button></a>
    </div>
</x-guest-layout>