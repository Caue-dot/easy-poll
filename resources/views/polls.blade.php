
<html>
<head>
    <title>Enquetes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@vite([
   'resources/js/app.js',
   'resources/js/poll.js',
   'resources/css/app.css'
])


<body>
<x-header></x-header>
<main class="flex flex-col items-center">
    <h1 class="font-bold text-2xl mb-10">Minhas Enquetes</h1>
    <div class="sm:w-200">
        <div class="grid grid-cols-3 text-center mb-1 sm:mb-1.5 p-2 gap-y-2 ">
            <div>Titulo</div>
            <div>Status</div>
            <div>Tempo restante</div>
        </div>

        <div class="flex flex-col gap-y-2">
            @foreach($polls as $poll)
                <a href="/polls/{{$poll->id}}" class="grid grid-cols-3 text-center bg-cyan-500 hover:bg-sky-700 rounded-sm text-white p-2 sm:p-2.5">
                    <div class="font-bold text-center"> {{$poll->title}}</div>
                    <div class="text-center">{{$poll->status === "active" ? "Ativo" : "Inativo"}}</div>
                    <div class="text-center">{{ $poll->time_left > 0 ? $poll->time_left : 0 }} hora{{ $poll->time_left > 1 ? "s" : "" }}</div>
                </a>
            @endforeach
        </div>

    </div>
</main>

</body>


</html>

