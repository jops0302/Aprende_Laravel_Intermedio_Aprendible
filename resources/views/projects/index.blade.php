@extends('plantilla')

@section('title', 'portafolio')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        @isset($category)
        <div>
        <h1 class="display-4 mb-0">{{ $category->name }}</h1>
        <a href="{{ route('projects.index') }}">Regresar al Portafolio</a>
        </div>
        @else
        <h1 class="display-4 mb-0">@lang('Projects')</h1>
        @endisset
        @can('create', $newProject)
        <a class="btn btn-primary" href=" {{ route('projects.create') }} ">Crear Proyecto</a>
        @endcan
    </div>

    <p class="lead text-secondary">Proyectos realizados Lorem
        ipsum dolor sit amet consectetur adipisicing elit.
        Aliquid, voluptatibus.</p>



    <div class="d-flex flex-wrap justify-content-between align-items-start">
        @forelse ($projects as $project)
        <div class="card border-0 shadow-sm mt-4 mx-auto" style="width: 18rem">

            @if($project->image)
            <img class="card-img-top" style="height: 150px; object-fit: cover;" src="/storage/{{ $project->image }}" alt="{{ $project->title }}">
            @endif

            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('projects.show', $project)  }}"> {{ $project->title }}</a>
                </h5>
                <h6 class="card-subtitle">
                    {{ $project->created_at->format('d/m/a') }}
                </h6>
                <p class="card-text text-truncate">{{ $project->description }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('projects.show', $project) }}" class="btn btn-primary btn-sm">
                        ver más...</a>
                    @if($project->category_id)
                     <a href="{{ route('categories.show', $project->category) }}" class="badge badge-secondary">{{ $project->category->name }}</a>
                    @endif
                </div>
            </div>



        </div>


        @empty
        <div class="card">
            <div class="card-body">
                no hay portafolios para mostrar
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-4">
     {{ $projects->links() }} 

    </div>

    @can('view-deleted-projects')
    <h4>Papelera</h4>
    <ul class="list-group">
        @foreach($deletedProjects as $deletedProject)
        <li class="list-group-item">{{ $deletedProject->title}}
            @can('restore', $deletedProject)
            <form method="POST" action=" {{ route('projects.restore', $deletedProject) }} " class="d-inline">
                @csrf @method('PATCH')
                <button class="btn btn-sm btn-info">Restaurar</button>
            </form> 
            @endcan

            @can('forceDelete', $deletedProject)
            <form method="POST"
                onsubmit="return confirm('Esta accion no se puede deshacer, ¿estás seguro de querer eliminar este proyecto?')"
                action=" {{ route('projects.forceDelete', $deletedProject) }} " class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Eliminar permanentemente</button>
            </form>
            @endcan
        </li>
        @endforeach
    </ul>
    @endcan

</div>

@endsection






















{{--

@extends('plantilla')

@section('title', 'portafolio')

@section('content')

<div class="container">

<h1 class="display-4">@lang('Projects')</h1>

@auth
<a href=" {{ route('projects.create') }} ">Crear Proyecto</a>
@endauth


{{-- <ul>
  @isset($portfolio)
    @foreach ($portfolio as $portfolioItem) 
    <li>{{ $portfolioItem['title'] }}</li>
@endforeach
@else
<li>no hay portafolios para mostrar</li>
@endisset
</ul> --}}

{{-- @for()
@endfor

@while()
@endwhile

@switch()
@endswitch 

<ul class="list-group">
  
    @forelse ($projects as $project) 
    <li>{{ $portfolioItem['title'] }}
<pre> {{ $loop->last ? ' es el ultimo' : '' }} </pre>
</li> el loop sirve para ver entrar a propiedades de el objeto
<li>{{ $portfolioItem->title }} <br><small> {{ $portfolioItem->description }} </small> <br> {{ $portfolioItem->created_at->diffForHumans() }} </li>
<li class="list-group-item border-0 mb-3 shadow-sm">
    <a class="d-flex justify-content-between align-items-center" href=" {{ route('projects.show', $project) }} ">

        <span class="text-secondary bold">
            {{ $project->title }}
        </span>
        <span class="text-black-50">
            {{ $project->created_at->format('d/m/a') }}
        </span>
    </a>
</li>


@empty
<li class="list-group-item border-0 mb-3 shadow-sm">
    no hay portafolios para mostrar</li>
@endforelse
{{ $projects->links() }}
</ul>

</div>

@endsection --}}