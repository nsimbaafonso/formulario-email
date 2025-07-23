@extends('site.layout')
@section('title', 'Formulário 1')
@section('conteudo')
    <!--container-->
    <section class="container-sm py-3 w-75">
        <h1 class="text-center">Formulário de Contato Ajax</h1>
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

        

        <form action="{{ route('site.enviarAjax') }}" method="POST" id="form-contato" enctype="multipart/form-data" autocomplete="on">
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

         <div class="loading-overlay" id="loading-overlay">
            <div style="text-align: center;">
                <i class="fas fa-spinner fa-spin fa-4x text-white"></i>
                <p style="color: #fff; font-size: 1.2rem; margin-top: 10px;">Enviando mensagem...</p>
            </div>
        </div>
    </section>
    <!--container end-->
@endsection

@push("style")
    <link href="https://cdn.jsdelivr.net/npm/jbox/dist/jBox.all.min.css" rel="stylesheet">
@endpush

@push("script")
    <script src="https://cdn.jsdelivr.net/npm/jbox/dist/jBox.all.min.js"></script>
@endpush

@push("script-envia")
    <script>
        $(document).ready(function () {
            $('#form-contato').on('submit', function (e) {
                e.preventDefault(); // evita o envio padrão

                let form = $(this)[0];
                let formData = new FormData(form);

                // Mostrar o loading
                $('#loading-overlay')
                .css('display', 'flex')  // garante centralização
                .hide()
                .fadeIn(7000); // tempo reduzido para aparecer suavemente

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    success: function (response) {
                        new jBox('Notice', {
                            content: 'Mensagem enviada com sucesso!',
                            color: 'green',
                            autoClose: 5000,
                            animation: 'zoomIn'
                        });

                        // Limpa o formulário
                        $('#form-contato')[0].reset();
                    },
                    error: function (xhr) {
                        let msg = 'Não foi possível enviar a mensagem. Tente novamente mais tarde.';

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            msg = '<b>Erros:</b><br>';
                            $.each(errors, function (key, value) {
                                msg += '• ' + value[0] + '<br>';
                            });
                        }

                        new jBox('Notice', {
                            content: msg,
                            color: 'red',
                            autoClose: 5000,
                            animation: 'zoomIn'
                        });
                    },
                    complete: function () {
                        // Ocultar o loading (sempre, mesmo com erro)
                        $('#loading-overlay').fadeOut(200);
                    }
                });
            });
        });
    </script>
@endpush
