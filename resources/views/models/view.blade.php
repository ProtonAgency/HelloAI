@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 text-left pull-left">
                    <h2>Model {{ $model->identifier }}</h2>
                </div>
                <div class="col-md-6 text-right pull-right">
                    <a href="{{ route('models') }}">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 mr-2">
                    <div class="card">
                        <div class="card-body">
                            <h3>Model Information</h3>

                            <table class="table">
                                <tr>
                                    <th>Name:</th>
                                    <td>{{ $model->name }}</td>
                                </tr>
                                <tr>
                                    <th>Identifier:</th>
                                    <td>{{ $model->identifier }}</td>
                                </tr>
                                <tr>
                                    <th>Type:</th>
                                    <td>{{ $model->type }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>{{ $model->getTextStatus() }}</td>
                                </tr>
                                <tr>
                                    <th>Accuracy:</th>
                                    <td>{{ $model->getAccuracy() }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>                
                </div>
                <div class="col-md-6 mr-2">
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
