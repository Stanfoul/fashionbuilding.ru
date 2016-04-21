<?php
$site="localhost";
$base="fash_build";
$msqlilog="root";
$msqlipass="";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Notification Types</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="demonstration of some noty capabilities">

    <link href='http://fonts.googleapis.com/css?family=PT+Sans:regular,italic,bold,bolditalic&amp;subset=latin,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
    <style type="text/css">

        html {
            height: 100%;
            width: 100%;
        }

        body {
            font-family: 'PT Sans', Tahoma, Arial, serif;
            line-height: 13px
        }

    </style>

    <link rel="stylesheet" type="text/css" href="buttons.css"/>

</head>
<body>

<div class="container">

    <div id="customContainer"></div>

</div>


<script src="js/jquery-1.8.0.js"></script>

<!-- noty -->
<script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.js"></script>

<script type="text/javascript">

    function generate(type) {
        var n = noty({
            text        : type,
            type        : type,
            dismissQueue: true,
            timeout     : 10000,
            closeWith   : ['click'],
            layout      : 'topCenter',
            theme       : 'defaultTheme',
            maxVisible  : 10
        });
        console.log('html: ' + n.options.id);
    }

    function generateAll() {
        generate('alert');
        generate('information');
        generate('error');
        generate('warning');
        generate('notification');
        generate('success');
    }

    $(document).ready(function () {

        generateAll();

    });

</script>
</body>
</html>
