<html>
<head>
    <title>Poll</title>
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
    <h1 class="text-2xl font-bold mt-10 sm:mt-0 mb-10">{{ $poll->title }}</h1>
    <div class="flex w-80 sm:w-100 flex-col">
        <ol class="flex flex-col gap-2 mb-5" id="poll-list">
            <div class="text-lg font-medium">Alternativas:</div>
            @foreach($poll->alternatives as $alternative)
                <div>
                    <li class="grid grid-cols-1 gap-3 items-stretch" data-id="{{ $alternative->id }}">

                        <button
                            class="rounded-sm bg-cyan-500 hover:bg-sky-700 text-white cursor-pointer p-1.5 font-medium
                        disabled:font-light disabled:border disabled:border-gray-300
                        disabled:text-gray-500 disabled:bg-transparent disabled:cursor-not-allowed"
                            {{$voted || $poll->status == 'unactive' ? 'disabled' : ''}}
                            data-alternative-id="{{ $alternative->id }}"
                            id="vote-{{ $alternative->id }}}"> {{$alternative->title}}:
                            <span class="votes">{{$alternative->votes_count}} </span></button>
                    </li>
                </div>
            @endforeach
        </ol>
        <div class="mb-40 1xl:mb-80 2xl:mb-80 text-left w-full" id="information-container">
            @if($poll->status == 'unactive')
                <p>Essa enquete já encerrou!</p>
                <p>Deseja começar uma nova? <a class="text-blue-600 font-medium underline" href="/polls/create">Criar
                        nova enquete</a></p>
            @elseif(request()->cookie("voted_$poll->id"))
                <p class="text-left">Seu voto já foi registrado nessa enquete!</p>
            @endif
            <p class="text-green-500 font-medium" id="success-message"></p>

            <p class="text-red-600 font-medium mt-2" id="error-message"></p>
        </div>


    </div>
        <div class="w-87 sm:w-130">
            <div class="text-blue-600 font-medium mb-2">Link da Enquete(Clique para copiar):</div>
            <button id="copy-link" class="w-87 sm:w-130 p-1.5 border border-gray-300
                        text-black bg-transparent cursor-pointer">{{url('polls/' . $poll->id) }}</button>
        </div>

</main>

</body>


</html>

