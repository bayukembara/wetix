@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Arrange Movie</h3>
                </div>
                <div class="col-4 text-right">
                    <button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{ route($url, $studio->id ?? '') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($studio))
                            @method('put')
                        @endif
                        <input type="hidden" name="theater_id" value="{{ $theater->id }}">
                        <div class="form-group">
                            <label for="movie">Movie</label>
                            <select name="movie_id" class="form-control">
                                <option value="">Pilih Movie</option>
                                @foreach($movies AS $movie)
                                    @if($movie->id == (old('movie_id') ?? $studio->movie_id ?? ''))
                                        <option value="{{ $movie->id }}" selected>{{ $movie->title }}</option>
                                    @else
                                        <option value="{{ $movie->id }}">{{ $movie->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('movie_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="studio">Studio</label>
                            <input type="text" class="form-control @error('studio') {{ 'is-invalid' }} @enderror" name="studio" value="{{ old('studio') ?? $studio->studio ?? '' }}">
                            @error('studio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control @error('price') {{ 'is-invalid' }} @enderror" name="price" value="{{ old('price') ?? $studio->price ?? '' }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-row mt-4">
                            <div class="col-2 align-self-center">
                                <label for="seats">Seats</label>
                            </div>
                            <div class="col-5">
                                @php 
                                    $seats = isset($studio->seats) ? json_decode($studio->seats) : false;
                                @endphp
                                <input type="number" placeholder="Rows" class="form-control @error('rows') {{ 'is-invalid' }} @enderror" name="rows" value="{{ old('rows') ?? $seats->rows ?? '' }}">
                                @error('rows')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <input type="number" placeholder="Columns" class="form-control @error('columns') {{ 'is-invalid' }} @enderror" name="columns" value="{{ old('columns') ?? $seats->columns ?? '' }}">
                                @error('columns')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label for="schedules">Schedules</label>
                        </div>
                        <div class="card mb-3">                        
                            <div class="card-body">
                                <schedule-component :old-schedules="{{ $studio->schedules ?? json_encode(old('schedules') ?? []) }}"></schedule-component>
                            </div>
                            @error('schedules')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <div class="form-group mb-0">
                                <label for="status">Status</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="coming soon" id="coming soon" @if((old('status') ?? $studio->status ?? '') == 'coming soon') checked @endif >
                                <label for="coming soon" class="form-check-label">Coming Soon</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="in theater" id="in theater" @if((old('status') ?? $studio->status ?? '') == 'in theater') checked @endif>
                                <label for="in theater" class="form-check-label">In Theater</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="finish" id="finish" @if((old('status') ?? $studio->status ?? '') == 'finish') checked @endif>
                                <label for="finish" class="form-check-label">Finish</label>
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-0">
                            <button type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-success btn-sm">{{ $button }}</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>

    @if(isset($studio))
        <div class="modal fade" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Delete</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus arrange movie</p>
                    </div>

                    <div class="modal-footer">
                        <form action="{{ route('dashboard.theaters.studio.delete', $studio->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection