<header class="bg-white h-23  flex justify-between align-middle p-12">
    <div class="flex items-center">
        <a href="/" class="text-3xl font-bold">EasyPoll</a>
    </div>

    <div class="hidden sm:flex items-center gap-5">
        <a href="/" class="cursor-pointer hover:underline font-medium"> Pagina Inicial </a>
        <a href="/polls/create" class="cursor-pointer hover:underline font-medium"> Criar Enquete</a>
        <a href="/polls/all" class="cursor-pointer hover:underline font-medium"> Minhas Enquetes </a>
        @if(Auth::check())
            <form action="/users/logout" method="POST">
                @csrf
                <button type="submit" class="cursor-pointer hover:underline font-medium">Sair</button>
            </form>
        @else
            <a href="/login" class="cursor-pointer hover:underline font-medium">Login/Registrar</a>
        @endif
    </div>
</header>
