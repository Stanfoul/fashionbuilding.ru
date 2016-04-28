<?php
$site="localhost";
$base="fash_build";
$msqlilog="root";
$msqlipass="mysql";
function alert($string)
{
  print '<script type="text/javascript">alert("' . $string . '");</script>';
}
function phonable($string){
  $str='+7('.substr($string,0,3).')-';
  $string=substr($string,3);
  $str=$str.substr($string,0,3).'-';
  $string=substr($string,3);
  $str=$str.substr($string,0,2).'-'.substr($string,2);
  return $str;
}
function filter($string){
  $string=str_replace("<","",$string);
  $string=str_replace("/","",$string);
  $string=str_replace(">","",$string);
  return $string;
}
function gen_salt(){  //ФУНКЦИЯ ГЕНЕРАЦИИ СОЛИ ДЛЯ ШИФРОВАНИЯ ПАРОЛЯ
  $salt='';
  $symbols='0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
  for ($i=0;$i<8;$i++){
    $salt=$salt.substr($symbols,rand(0,61),1);
  }
  $salt='$1$'.$salt.'$';
  return $salt;
}
function gen_hash(){ //ФУНКЦИЯ ГЕНЕРАЦИИ ХЭША
  $salt='';
  $symbols='0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
  for ($i=0;$i<8;$i++){
    $salt=$salt.substr($symbols,rand(0,61),1);
  }
  $salt='$1$'.$salt.'$';
  $hash=$_SERVER['REMOTE_ADDR'];
  $hash=crypt($hash,$salt);
  return $hash;
}
if(!function_exists('hash_equals'))
{
    function hash_equals($str1, $str2)
    {
        if(strlen($str1) != strlen($str2))
        {
            return false;
        }
        else
        {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--)
            {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}
error_reporting(0);
$mysqli = new mysqli($site, $msqlilog, $msqlipass, $base); //СВЯЗЬ С БАЗОЙ
if ($mysqli->connect_errno) {
    print "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;	//В СЛУЧАЕ ОШИБКИ ПОДКЛЮЧЕНИЕ К БАЗЕ
}else{
	error_reporting(1);
}
?>
