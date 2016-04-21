<?php
require_once("main_php/conect.php");
function alert($string)
{
    print '<script type="text/javascript">alert("' . $string . '");</script>';
}
if (isset($_COOKIE['id'])){
	$query="SELECT hash FROM `log` WHERE user_id LIKE '".$_COOKIE['id']."' " ;
	if($result=$mysqli->query($query)){
		while($obj=$result->fetch_object()){
			if((!hash_equals($obj->hash,$_COOKIE['h']))||(hash_equals($obj->hash,crypt($_SERVER['REMOTE_ADDR'],$obj->hash)))){
				alert('successfull in');
			}else{
				header("Location:main_php/clear.php");
			}
		}
	}
}
if (isset($_POST['button1'])){
	header("Location:main_php/clear.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/main-carcas.css">
    <link rel="stylesheet" href="css/media-carcas.css">
    <link rel="stylesheet" href="css/profil.css">
    <link rel="stylesheet" href="css/fonts.css">
</head>
<body>
    <header class="home-head">
    <div class="city">
        <h1>г. Москва</h1>
    </div>
    <div class="head-line">
        <nav class="home-nav flex space--between">
            <div class="info-user">
                <p>357</p>
                <img src="img/user-number.png">
            </div>
            <div class="peppol">
                <img src="img/icon-people.png">
            </div>
            <div class="logo"><a href="index.php"><img src="img/logo.png" alt="fashion"></a></div>
            <ul class="message">
                <li class="prigl"><a class="mb" href="#">Приглашения (<span class="count">0</span>)</a>
                <div class="locpr">
                    <div class="hey">
                        <div class="dropdown_arr"></div>
                    <div class="ticket flex space--between">
                    <a href="#" class="buyt">Приобрести билеты</a>
                    <p>Здесь будут отображаться билеты которые Вы приобрели</p>
                </div>
                </div>
            </div>
                </li> 
            </ul>
        </nav>
    </div>
</header>
<div class="bel-line"></div>
<section class="internet-konk">
    <div class="int-mid">
        <div class="section-title">Интернет конкурс!</div>
        <div class="section-pre-title"><p>Победители конкурса определяются и награждаются на мероприятиях «FashionBuilding» каждый месяц!</p></div>
        <div class="sect-bot-l">
            <ul class="flex space--around">
                <li><a href="#" class="watch-all w">Смотреть всех </a></li>
                <li><a href="#" class="prim">Прими участие!</a></li>
                <li><a href="#" class="watch-all m">Смотреть всех </a></li>
            </ul>
        </div>
        <div class="user">
            <div class="user-info">
                <img src="img/woom.jpg">
                <div class="info">
                    <h1>К конкурсу 10.06.2016 у Вас:</h1>
                    <p><span class="number">686</span> голосов<br> <span class="number">67</span> Место в конкурсе <br>Всего голосов <span class="number">10847</span><br> В начале конкурса было <span class="number">678</span></p>
                </div>
            </div>
        </div>
        <div class="foto-user">
            <h1>Ваши фотографии</h1>
            <div class="foto">
                <img src="img/cross.png" class="close">
                <img src="img/mann.png" class="active">
            </div>
             <div class="foto">
                <img src="img/cross.png" class="close">
                <img class="mann" src="img/mann.png">
            </div>
             <div class="foto">
                <img src="img/cross.png" class="close">
                <img src="img/mann.png" class="mann">
            </div>
            <div class="foto">
                <img src="img/cross.png" class="close">
                <img src="img/mann.png" class="mann">
            </div>
            
            <div class="add">
                <a href="#">Добавить+</a>
            </div>
        </div>
    </div>
    <div class="int-mid">
        <div class="poster"> 
            <div class="item">
                 <div class="left_part">
                        <p class="title">Участие в конкурсе<span><br>Вы не участвуете</span></p>
                        <div class="image_poster">
                            <p>Афиша конкурса</p>
                        </div>
                </div>
                <div class="right_part">
                    <p class="title-right"><span>2016</span> Март 12 пятница, в 15:00</p>
                    <h3>Парк культуры и отдыха ЦКПО им. М. Горького</h3>
                    <p>Электронный номер билета: <span>8676-2345-6</span></p>
                    <p>Адрес: жыдваыовлаоываываыв</p>
                    <p>Телефон организаторов: +7(903)228-08-82</p>
                </div>
            </div>
        </div>
    </div>
     <div class="poster"> 
        <div class="left">
            <h1>Ваши данные</h1>
            <a href="#">(Редектировать)</a>
            <p>Имя:Андрей Белый<br>Номер телефона:<span>Отсутствует!<br>Прияжите номер телефона для<br>получения электронных билетов<br> и смс уведомлений<br></span> E-mail:Отсутствует!<br>Привяжите для получения<br>уведомлений на электронную<br> почту!<br> Логин:97235987329845 <br>Пароль:0832058</p>
        </div>
        <div class="right">
            <h1>Привязать аккаунты из соц сете<br>для быстрого входа</h1>
            <a href="#">Тут логотипы соц сетей</a>
            <h2>Найстройка уведомлений</h2>
            <p>Я согласен(а) получать смс уведомления<br> от портала «FashionBuilding» раз в неделю</p>
        </div>
    </div>
    
</section>
