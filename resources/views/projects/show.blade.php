@extends('plantilla')

@section('title', 'Portafolio |' . $project->title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-8 mx-auto">
            @if($project->image)
            <img class="card-img-top" src="/storage/{{ $project->image }}" alt="{{ $project->title }}">
            @endif
            <div class="bg-white p-5 shadow rounded">

                <h1 class="mb-0">{{ $project->title }}</h1>

                @if($project->category_id)
                <a href="{{ route('categories.show', $project->category) }}" class="badge badge-secondary mb-1">{{ $project->category->name }}</a>
                @endif

                <p class="text-secondary">
                    {{ $project->description }}
                </p>
                <p class="text-black-50">
                    {{ $project->created_at->diffForHumans() }}
                </p>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('projects.index') }}">
                        Regresar
                    </a>
                    @auth
                    <div class="btn-group btn-group-sm">
                        @can('update', $project)
                        <a class="btn btn-primary" href="{{ route('projects.edit', $project) }}">Editar</a>
                        @endcan
                        @can('delete', $project)
                        <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-project').submit()">Eliminar</a>
                        @endcan
                    </div>
                    @can('delete', $project)
                        <form id="delete-project" class="d-none" method="POST" action="{{ route('projects.destroy', $project) }}">
                            @csrf @method('DELETE')
                        </form>
                    @endcan
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection