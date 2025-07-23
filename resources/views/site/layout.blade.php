<!DOCTYPE html>
<html lang="pt-ao">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield("title")</title>
    <link href="{{ asset('fonts/fontawesome-6.5.2/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/fontawesome-6.5.2/css/brands.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/fontawesome-6.5.2/css/solid.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}?<?= time(); ?>">
    @stack("style")
    <style type="text/css">
        body{
            background-color: #edeaef;
        }
        .loading-overlay{
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0; left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, .7);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
            transition: opacity .3s ease;
        }
    </style>
</head>
<body>
    <header class="d-flex flex-wrap justify-content-center py-3 bg-dark mb-4 border-bottom">
        <a href="{{ route('site.index') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4 text-white">Formulários</span>
        </a>

        <ul class="nav nav-pills">
            <li class="nav-item"><a href="{{ route('site.index') }}" class="nav-link active" aria-current="page">Formulário 1</a></li>
            <li class="nav-item"><a href="{{ route('site.indexAjax') }}" class="nav-link text-white">Formulário 2</a></li>
        </ul>
    </header>
    

    @yield("conteudo")
    
    <footer class="py-3 bg-dark">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="{{ route('site.index') }}" class="nav-link px-2 text-white">Formulário 1</a></li>
            <li class="nav-item"><a href="{{ route('site.indexAjax') }}" class="nav-link px-2 text-white">Formulário 2</a></li>
        </ul>
        <p class="text-center text-white">© 2024 Company, Inc</p>
    </footer>

    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @stack("script")
    @stack("script-envia")
</body>
</html>