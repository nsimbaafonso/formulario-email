@extends('site.layout')
@section('title', 'Formulário 1')
@section('conteudo')
    <!--container-->
    <section class="container-sm py-3 w-75">
        <h1 class="text-center">Formulário de Contato</h1>
        @if(session('sucesso'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('erro'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('erro') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        

        <form action="{{ route('site.enviar') }}" method="POST" enctype="multipart/form-data" autocomplete="on">
            @method("POST")
            @csrf
            <div class="my-3">
                <input class="form-control form-control-lg" type="text" name="nome" id="nome" placeholder="Seu nome" value="{{ old('nome') }}">
            </div>

            <div class="my-3">
                <input class="form-control form-control-lg" type="email" name="email" id="email" placeholder="exemplo@gmail.com" value="{{ old('email') }}">
            </div>

            <div class="my-3">
                <input class="form-control form-control-lg" type="text" name="assunto" id="assunto" placeholder="Seu assunto" value="{{ old('assunto') }}">
            </div>

            <div class="my-3">
                <input type="file" name="imagem" class="form-control form-control-lg" aria-label="Large file input example">
            </div>

            <div class="my-3">
                <textarea class="form-control form-control-lg" name="mensagem" id="mensagem" placeholder="Sua mensagem..." style="height: 150px; resize: none;">{{ old('mensagem') }}</textarea>
            </div>

            <button type="submit" name="enviar" class="btn btn-lg btn-primary w-100">ENVIAR MENSAGEM</button>
         </form>
    </section>
    <!--container end-->
@endsection
