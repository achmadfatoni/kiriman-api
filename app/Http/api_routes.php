<?php
	
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

	$api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');
	$api->post('auth/signup', 'App\Api\V1\Controllers\AuthController@signup');
	$api->post('auth/recovery', 'App\Api\V1\Controllers\AuthController@recovery');
	$api->post('auth/reset', 'App\Api\V1\Controllers\AuthController@reset');

	// example of protected route
	$api->get('protected', ['middleware' => ['api.auth'], function () {		
		return \App\User::all();
    }]);


	$api->get('kota', function(){
		return RajaOngkir::Kota()->all();
	});

	$api->get('cost/{origin}/{destination}', function($origin, $destination){
		return  RajaOngkir::Cost([
			'origin'        => $origin, // id kota asal
			'destination'   => $destination, // id kota tujuan
			'weight'        => 1000, // berat satuan gram
			'courier'       => 'jne', // kode kurir pengantar ( jne / tiki / pos )
		])->get();
	});

});
