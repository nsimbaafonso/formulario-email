<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova mensagem de contato</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; padding: 20px;">

    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Nova mensagem do site</h4>
            </div>

            <div class="card-body">
                <p><strong>Nome:</strong> {{ $dados['nome'] }}</p>
                <p><strong>Email:</strong> {{ $dados['email'] }}</p>
                <p><strong>Assunto:</strong> {{ $dados['assunto'] }}</p>

                <hr>

                <p><strong>Mensagem:</strong></p>
                <p class="bg-light p-3 rounded">{{ $dados['mensagem'] }}</p>

                @if (!empty($imagem))
                    <div class="alert alert-info mt-3">
                        <strong>Imagem:</strong> Um arquivo foi enviado em anexo.
                    </div>
                @endif
            </div>

            <div class="card-footer text-muted text-end">
                Enviado em {{ now()->format('d/m/Y H:i') }}
            </div>
        </div>
    </div>
</body>
</html>
