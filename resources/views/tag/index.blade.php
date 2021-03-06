@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('tags.create') }}" class="btn btn-primary">Add Tag</a>
    </div>
    <div class="card">
        <div class="card-header">
            Tags
            @include('partials.message')
            @include('partials.error-message')
        </div>
        <div class="card-body">
        @if(count($tags)>0)
        <ul class="list-group">
            @foreach($tags as $tag)
                <li class="list-group-item">{{ $tag->name }} ({{ $tag->posts->count() }})
                    <span class="float-right ml-2">
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </span>
                   @if(!$tag->trashed()) 
                   <span class="float-right">
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary">Edit</a>
                    </span>
                    @else
                    <span class="float-right ml-2">
                        <form action="{{ route('restore-tag', $tag->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-info text-white">Restore</button>
                        </form>
                    </span>
                    @endif
                </li>
            @endforeach
        </ul>
        @else
            <h3 class="text-center">No Tag Yet</h3>
        @endif
        </div>
    </div>
@endsection
