<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<!-- //php artisan serve* para prender el server -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloc de Notas</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

<body class="bg-gray-300">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <center>
        <h1>Bloc de Notas</h1>
    </center>
    <div class="container mx-auto p-3">

        <form action="{{route('add')}}" method="POST" class="ms-5 me-5">
            @csrf
            @if(session('mensaje'))

            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    {{session('mensaje')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @endif
            @error('title')
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Campo vacio de titulo....
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @enderror
            @error('body')
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    Campo vacio de descripcion....
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            @enderror

            <div class="mb-3 ">
                <label class="form-label">Titulo</label>
                <input type="text" name="title" class="form-control" placeholder="Ingresa Titulo" value="{{old('title')}}">
            </div>
            <div class="mb-3 bottom ">
                <label class="form-label">Texto</label>
                <textarea class="form-control" name="body" rows="5">{{old('body')}}</textarea>
            </div>
            <center><div class="mt-12 flex">
                <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-full">Crear Nota</button>
            </div></center>
        </form>
    </div>
    <div class="container-sm pt-4">
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($notes as $item)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted position-absolute top-0 end-0 m-1">id: {{$item->id}}</h6>
                        <h5 class="card-title">{{$item->title}}</h5>
                        <p class="card-text text-gray-700 text-base">{{$item->body}}</p>
                        <div class="fas fa-link">
                            <a href="{{ route('update',$item)}}" class="btn" class="fab fa-github">Editar</a>
                        </div>
                        <form class="d-inline" action="{{ route('delete',$item)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>

                    </div>
                </div>
            </div>
            @endforeach()
        </div>
    </div>
    
    <div class="pt-3 pagination justify-content-center">{{ $notes->links('pagination::bootstrap-4') }}</div>
</body>

</html>