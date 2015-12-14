<?php

namespace Services;


class Mail extends \PHPMailer
{
    public function __construct($to)
    {
        parent::__construct();
        $config = require BASE_PATH.'/config/mail.php';
        $this->isSMTP();
        $this->setFrom($config['Username']);
        foreach($config as $k => $v){
            $this->$k = $v;
        }
        if( is_array($to) ){
            foreach ($to as $email){
                $this->addAddress($email);
            }
        }
    }

    public static function to($to)
    {
        if( !$to ){
            throw new \phpmailerException('收件人不能为空');
        }
        return new Mail($to);
    }

    public function setFrom($email,$name = 'eric', $auto = true)
    {
        if(!$email){
            throw new \phpmailerException('发送地址不能为空');
        }
        parent::setFrom($email,$name,$auto);
        return $this;
    }
    public function addFile($file)
    {
        if(file_exists($file)){
            $this->addAttachment($file);
            return $this;
        }
        throw new \phpmailerException('文件不存在');
    }

    public function isHTML($switch = true)
    {
        parent::isHTML($switch);
        return $this;
    }

    public function setTitle($title)
    {
        if( $title ){
            $this->Subject = $title;
            return $this;
        }
        throw new \phpmailerException('标题不能为空');
    }

    public function setContent($content)
    {
        if( $content ){
            $this->Body = $content;
            return $this;
        }
        throw new \phpmailerException('内容不能为空');
    }

    public function __destruct()
    {
            if($this->send()){
                echo 'ok';
            }else{
                echo $this->ErrorInfo;
            }
    }

}