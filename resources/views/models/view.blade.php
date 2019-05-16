@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-6 text-left pull-left">
                    <h2>{{ $model->identifier }}</h2>
                </div>
                <div class="col-md-6 text-right pull-right">
                    <a href="{{ route('models') }}">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Model Information</h3>

                            <table class="table table-borderless">
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

                            <a class="btn btn-danger" href="{{ route('models.delete', ['identifier' => $model->identifier]) }}">
                                <i style="color: white !important;" class="fa fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
