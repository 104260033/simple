<?php
namespace App\controllers;


use App\models\Article;
use Services\Log;
use Services\ly;
use Services\Redis;
use Services\View;
use Services\Mail;

/*
 * simple 示例
 * */
class WelcomeController extends BaseController
{
    public function home()
    {
             View::make('welcome')
                 ->with('article',Article::first())
                 ->withTitle('Title')
                 ->withFine('我很棒')
                 ->withEricFzy('I`m Eric.fzy"');
    }

    public function email()
    {
                Mail::to(['104260033@qq.com','eric.fzy@gmail.com'])
                    ->setTitle('FZY PHPmaier')
                    ->setContent('<h1>这是邮件内容</h1>')
                    ->isHTML();
    }

    public function cache()
    {
        Redis::set('tt',123,1,'h');
        var_dump(Redis::get('tt'));
    }

    public function log()
    {
        Log::debug(serialize($this));
        Log::ERROR('ERROR');
        Log::INFO('ERROR');
        Log::NOTICE('ERROR');
        Log::WARNING('ERROR');
        Log::CRITICAL('ERROR');
        Log::ALERT('ERROR');
        Log::EMERGENCY('ERROR');
    }
    public function test(){
        ly::test();
    }


}