<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home - Books Free</title>

        <!-- CSS -->
        <link rel="stylesheet" href="/css/style.css">

        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
        <div class="container">
            <header>
                <div class="header-content">
                    <div class="header-title">
                        <h1>Envie algum livro para o site</h1>
                    </div>
                    <div class="form">
                        <form enctype="multipart/form-data" action="{{ url('/verify') }}" method="post">
                            @csrf
                            <div class="input-title">
                                <label for="title">Título: </label>
                                <input type="text" name="title" id="title" placeholder="Título do Livro">
                            </div>
                            <div class="input-file">
                                <div class="warning">
                                    <span>* Livro em formato de PDF.</span>
                                </div>
                                <label for="file">Selecione o livro: </label>
                                <input type="file" name="file" id="file">
                            </div>
                            <!-- <div class="g-recaptcha" data-sitekey="your_site_key"></div> -->
                            <div class="input-send">
                                <input type="submit" name="submit" id="submit" value="Enviar Arquivo">
                            </div>
                        </form>

                        @if(count($errors) > 0)
                            <span id="error" class="error">Envie o arquivo novamente!</span>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li><span id="error" class="error">{{ $error }}</span></li>
                                @endforeach
                            </ul>  
                        @endif

                        @if($message = Session::get('error'))
                        <span id="error" class="error">OOPPSS! {{ $message }}</span>
                        @endif

                        @if($message = Session::get('success'))
                        <span class="error send">{{ $message }}</span>
                        @endif
                    </div>
                </div>
            </header>
            
            <main>
                <div class="title-main">
                    @if($search)
                    <h2>Buscando por: {{ $search }}</h2>        
                    @else
                    <h2>Livros Disponíveis</h2>
                    @endif
                    <h5>* Ao abrir o pdf clique para baixar</h5>
                </div>
                <div class="flex-center">
                    <div class="flex-end">
                        <form action="/" method="GET">
                            <div class="input-search">
                                <i class='bx bx-search-alt-2'></i>
                                <input type="search" name="search" id="search" placeholder="Procure por Livros">
                            </div>
                        </form>
                    </div>
                    <div class="flex-books">
                        @foreach($books as $book)
                        <div class="books">
                            <a href="/file/books/{{ $book->file }}" target="_blank" rel="noopener noreferrer"><img src="https://img.icons8.com/pastel-glyph/64/04aa6d/download--v1.png"/><span>{{ $book->title }}</span></a>
                        </div>
                        @endforeach
                        @if(count($books) == 0 && $search)
                            <p>Não possível encontrar nenhum livro com: {{ $search }}! <a href="/">Ver Todos!</a></p>
                        @elseif(count($books) == 0)
                            <p>Não há livros disponíveis!</p>
                        @endif
                    </div>
                </div>
            </main>
            
            <footer>
                <div class="warning-verify">
                    <p>* Caso queira verificar o PDF, clique: <a href="https://www.virustotal.com/gui/home/upload" target="_blank" rel="noopener noreferrer">VIRUSTOTAL</a></p>
                </div>
            </footer>
        </div>
    </body>
</html>
