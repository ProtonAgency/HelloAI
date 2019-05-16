@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <h2>HelloAI API Documentation v1</h2>

                    <p>
                        HelloAI has one primary base endpoint for all authentication and api endpoints. <code>https://ai.hellosoftware.co/api/</code>. All endpoints have a code example in PHP and NodeJS. We reccomend that PHP users use the GuzzlePHP library for making HTTP requests.
                    </p>

                    <h3>Authentication</h3>

                    <p>
                        HelloAI uses JWT (JSON Web Token) based authentication. You can login and fetch your account details via the API.
                    </p>

                    <h4>Login</h4>
                    <p>
                        <b>Endpoint:</b> <code>/auth/login</code>

                        <b>Example Request:</b>

                        <code>
<pre>
use GuzzleHttp\Client;

$client = new Client();

$auth_request = $client->post('https://ai.hellosoftware.co/api/auth/login', [
    'form_params' => [
        'email' => 'mail@example.com',
        'password' => 'MyV3ryS3cur3P@ssword!',
    ]
]);
</pre>                            
                        </code>

                        <b>Example Response:</b>

                        <code>
<pre>
{
    "access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvYWkuaGVsbG9zb2Z0d2FyZS5jb1wvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU1ODAzOTYwOCwiZXhwIjoxNTU4MDQzMjA4LCJuYmYiOjE1NTgwMzk2MDgsImp0aSI6Ilp0UFl3WjR2aWZnTllKNk0iLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.iEsh8a98k-qarnuHhQPF8CO9lWoLIZ9CxlFfpEOqAf4",
    "token_type":"bearer",
    "expires_in":3600
}
</pre>
                        </code>
                    </p>

                    <h3>Models</h3>

                    <h4>Create a new Model</h4>

                    <p>
                        <b>Endpoint:</b> <code>/v1/models/new</code>

                        <b>Example Request:</b>

                        <code>
<pre>
$token = ...;
$model_request = $client->post('https://ai.hellosoftware.co/api/v1/models/new', [
    'form_params' => [
        'name' => 'my model', //model name
        'type' => 'text_analysis', //no other type is supported right now
    ],
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
]);
</pre>
                        </code>

                        <b>Example Response:</b>

                        <code>
<pre>
    
</pre>
                        </code>
                    </p>

                    <h4>Train a Model</h4>

                    <p>
                        <b>Endpoint:</b> <code>/v1/models/{identifier}/train</code>

                        <b>Example Request:</b>

                        <code>
<pre>
$token = ...;
$identifier = ...;
$model_train = $client->post('https://ai.hellosoftware.co/api/v1/models/' . $identifier . '/train', [
    'form_params' => [
        'sftp' => [
            'host' => '127.0.0.1',
            'port' => 22,
            'username' => 'helloai',
            // 'password' => '...'
            'key' => file_get_contents('/path/to/ssh/key'),
            'directory' => '/path/to/dataset'
        ],
    ],
    'headers' => [
        'Authorization' => 'Bearer ' . $token,
    ],
]);
</pre>

                        <b>Example Response:</b>

                        <code>
<pre>
    
</pre>
                        </code>
                        </code>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
