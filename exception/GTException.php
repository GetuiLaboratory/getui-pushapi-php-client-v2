<?php

class GTException extends Exception
{
    var $requestId;
    //重定义构造器使第一个参数 message 变为必须被指定的属性
    public function __construct(){
        $a=func_get_args();
        $i=func_num_args();
        if(method_exists($this,$f='__construct'.$i)){
            call_user_func_array(array($this,$f),$a);
        }
    }
    function __construct1($a1){
        parent::__construct($a1);
    }

    function __construct3($a1,$a2,$a3){
        parent::__construct($a2,null, $a3);
        $this->requestId = $a1;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }
}