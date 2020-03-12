<!DOCTYPE html>
    <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <meta name="csrf-token" content="{{ csrf_token() }}">
          <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css')}}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          <link rel="stylesheet" href="{{asset('css/style.css')}}">
          <title>@yield('title')</title>
        </head>
        <body>
          <header>
            <nav class="navbar nav-ng">
                <a href="{{route('index')}}"><img class="img-logo" src="{{asset('img/logo.png')}}" alt="Logo NaturGest"></a>
                @switch(auth()->user()->name)
                  @case('operador')
                    <ul class="nav justify-content-center mt-auto">
                        <li class="nav-item">
                          <a class="nav-link btn-nav a-nav" href="#">Buscar Producto</a>
                        </li>
                        <li class="nav-item ml-3">
                        <a class="nav-link btn-nav a-nav" href="{{route('clientes')}}">Gestión Clientes</a>
                        </li>
                        <li class="nav-item ml-3">
                          <a class="nav-link btn-nav a-nav" href="#">Alertas</a>
                        </li>
                      </ul>
                      <div class="float-right mr-5">
                        <h4>Operador</h4>
                        <a href="{{route('index')}}"><img class="logo-user" src="{{asset('img/operador.png')}}" alt="Logo Operador"></a>
                        <form method="POST" action="{{route('logout')}}">
                          @csrf
                            <button type="submit" class="btn btn-sm mt-1 ml-3 btn-ng text-white">Cerrar Sesión</button>
                        </form>
                      </div>
                      @break
                  @case('administrador')
                    <ul class="nav justify-content-center mt-auto">
                      <li class="nav-item">
                        <a class="nav-link btn-nav a-nav" href="#">Buscar Producto</a>
                      </li>
                      <li class="nav-item ml-3">
                        <a class="nav-link btn-nav a-nav" href="{{route('clientes')}}">Gestión Clientes</a>
                      </li>
                      <li class="nav-item ml-3">
                        <a class="nav-link btn-nav a-nav" href="#">Alertas</a>
                      </li>
                    </ul>
                    <div class="float-right mr-5">
                      <h4 class="mr-1">Administrador</h4>
                      <a href="{{route('index')}}"><img class="logo-user mr-5" src="{{asset('img/admin.png')}}" alt="Logo Operador"></a>
                      <form method="POST" action="{{route('logout')}}">
                        @csrf
                          <button type="submit" class="btn btn-sm mt-1 ml-2 btn-ng text-white">Cerrar Sesión</button>
                      </form>
                    </div>
                    @break
                  @case('gerente')
                    <ul class="nav justify-content-center mt-auto">
                      <li class="nav-item">
                        <a class="nav-link btn-nav a-nav" href="{{route('controlSucursal')}}">Control Sucursal</a>
                      </li>
                      <li class="nav-item ml-3">
                        <a class="nav-link btn-nav a-nav" href="{{route('trabajadores')}}">Gestión Trabajadores</a>
                      </li>
                      <li class="nav-item ml-3">
                        <a class="nav-link btn-nav a-nav" href="#">Alertas</a>
                      </li>
                    </ul>
                    <div class="float-right mr-5">
                      <h4 class="mr-1">Gerente</h4>
                      <a href="{{route('index')}}"><img class="logo-user mr-5" src="{{asset('img/gerente.png')}}" alt="Logo Operador"></a>
                      <form method="POST" action="{{route('logout')}}">
                        @csrf
                          <button type="submit" class="btn btn-sm mt-1 ml-2 btn-ng text-white">Cerrar Sesión</button>
                      </form>
                    </div>
                    @break
                  @default
                    @break
              @endswitch
            </nav>
          </header>  
          <section class="container-fluid">
            @yield('content')

          </section>
          
          
          @extends('templates/scripts')
    </body>
</html>