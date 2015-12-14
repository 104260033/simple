<?php

use \NoahBuscher\Macaw\Macaw;


////var_dump($_SERVER);
//\Services\ly::get('/welcome',function(){
//    //var_dump(strpos('/home/test/','/',(strlen('/home/test/')-1)));
//    var_dump('welcome Done');
//});
//\Services\ly::get('/test',function(){
//    dd('test Done');
//});
//\Services\ly::get('/home/test','App\\controllers\\WelcomeController@home');
//\Services\ly::get('/home/test','App\\controllers\\WelcomeController@home');
\simple\Route::get(':all','App\\controllers\\WelcomeController@home');
\simple\Route::get(':all','App\\controllers\\WelcomeController@home');


\simple\Route::dispatch();


//Macaw::get('/welcome',"App\\controllers\\WelcomeController@home1");
//Macaw::get('/welcome',"App\\controllers\\WelcomeController@home");
//Macaw::get('/email',"App\\controllers\\WelcomeController@email");
//Macaw::get('/cache',"App\\controllers\\WelcomeController@cache");
//Macaw::get('/log',"App\\controllers\\WelcomeController@log");
//
//Macaw::get(':any',function(){
//    var_dump('any');
//});
//Macaw::get(':all','App\\controllers\\WelcomeController@home/App\controllers\WelcomeController@home');
//Macaw::get(':num',function(){
//    var_dump('没有找到页面 num');
//});



//Macaw::error(function(){
//   echo '没有找到页面';
//});


//Macaw::dispatch();