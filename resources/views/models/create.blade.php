@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 text-left pull-left">
                    <h2>Create Model</h2>
                </div>
                <div class="col-md-6 text-right pull-right">
                    <a href="{{ route('models') }}">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @error('general')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <form class="form" method="post" action="{{ url()->current() }}">
                        @csrf

                        <div class="form-group">
                            <label>Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Type <span style="color: red;">*</span></label>
                            <select class="form-control" name="type">
                                <option disabled selected>Select type...</option>
                                <option value="text_analysis">Text Analysis</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create Instance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
