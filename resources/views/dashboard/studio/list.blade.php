@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.theaters.studio.create', $theater->id) }}" class="btn btn-primary btn-sm">+ Studio</a>
    </div>
    
    @if(session()->has('message'))
        <div class="alert alert-success">
            <strong>{{ session()->get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Studio - {{ $theater->theater }}</h3>
                </div>

                <div class="col-4">
                    <form method="get" action="{{ route('dashboard.theaters.studio', $theater->id) }}">
                        <div class="input-group">
                        <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? '' }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>Movie</th>
                        <th>Studio</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- akan ditambahkan -->
                    @foreach ($studios as $studio)
                        <tr>
                            <td>{{ $studio->movies->title }}</td>
                            <td>{{ $studio->studio }}</td>
                            <td>{{ $studio->price }}</td>
                            <td>{{ $studio->status }}</td>
                            <td>
                                <a href="{{ route('dashboard.theaters.studio.edit', [$theater->id, $studio->id]) }}" title="edit" class="btn btn-success btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a> 
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection