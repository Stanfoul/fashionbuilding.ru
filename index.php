<?php
	require_once("main_php/conect.php"); //ПОДКЛЮЧЕННИЕ БАЗЫ
if(isset($_POST['button0'])){ //ПО КНОПКЕ ВОЙТИ
if(($_POST['login']!="")&&($_POST['pass']!="")){
	$on='0';
	$pass=filter($_POST['pass']);
	$login=filter($_POST['login']);
	$login = preg_replace('/[^0-9]/', '', $login);
	$login = substr($login,1);
	$query=("SELECT * FROM `log` WHERE login LIKE '".$login."'");
	$hash=gen_hash();
	if($result=$mysqli->query($query)){
		while($obj=$result->fetch_object()){
			if (($obj->login==$login)&&(hash_equals($obj->pass, crypt($pass, $obj->pass)))){
				if(!$mysqli->query("UPDATE `log` SET `hash`='{$hash}' WHERE `log`.`login` ='{$login}'")){
					print "Не удалось создать таблицу: (" . $mysqli->errno . ") " . $mysqli->error;
				}
				setcookie("id",$obj->user_id);
				setcookie("h",$hash);
				header("Location:profil.php");
				exit();
				$on='1';
			}else if($on=='0'){
				alert("Неверный логин/пароль");
				$on='1';
			}
		}
		if(($result->fetch_object()==null)&&($on=='0')){
			alert("Неверный логин/пароль");
			$on='1';
		}
	}
}else{
	alert("Введите все данные");
}
}
if(isset($_POST['button1'])){ //ПО КНОПКЕ ЗАРЕГИСТРИРОВАТЬСЯ
	$brik='1';
	if(($_POST['login1']!="")&&($_POST['pass1']!="")&&($_POST['pass_check']!="")){
		$login1=$_POST['login1'];
		$query=("SELECT * FROM `log` WHERE login LIKE '".$login1."'");
		if($result=$mysqli->query($query)){
			while($obj=$result->fetch_object()){
				alert('Такой логин уже существует');
				header("Refresh:0");
				exit;
			}
			if(($result->fetch_object()==null)){
				$brik='0';
			}
		}
		if ($_POST['pass1']==$_POST['pass_check']){
			$brik='1';
			$login1=filter($_POST['login1']);
			$login1 = preg_replace('/[^0-9]/', '', $login1);
			$login1 = substr($login1,1);
			$pass1=filter($_POST['pass1']);
			$pass1 = crypt($pass1,gen_salt());
			$hash=gen_hash();
			if(!$mysqli->query("CREATE TABLE IF NOT EXISTS log(user_id int NOT NULL AUTO_INCREMENT, login TEXT,pass TEXT,hash TEXT,grup TEXT , PRIMARY KEY (user_id))") ||
			!$mysqli->query("INSERT INTO log VALUES('0', '{$login1}' , '{$pass1}' , '{$hash}', 'stud' )")) {
				print "Не удалось создать таблицу: (" . $mysqli->errno . ") " . $mysqli->error;
			}
			print '<script type="text/javascript">showlog(1);</script>';
		}else{
			alert("Пароли не совпадают");
		}
	}else{
		alert("Введите все данные");
	}
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Starter</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/main-start.css">
</head>
<body>



 <!-- header start 1-->
<header class="home-head">
	<h1>г. Москва</h1>
	<!-- nav, logo start -->
	<div class="head-line">
		<nav class="home-nav flex space--between">
			<ul>
				<li class="personal"><a href="#">Личный кабинет</a>
					<!-- dropdown -->
					<div class="drop-down-log">
						<ul class="personal-cab">
							<div class="dropdown_arr"></div>
								<div id="log">
									<form method="POST">
										<li><input type="text" class="login" name="login" placeholder="Номер телефона/E-mail"></li>
										<li><input type="password" id="pass" name="pass" placeholder="Пароль"></li>
										<li><input type="submit" name="button0" value="Войти"></li>
										<li><input type="button" onclick="showlog('0')" value="Регистрация"></li>
									</form>
								</div>
								<div id="register" style="display:none">
									<form method="POST">
										<li><input type="text" class="login" name="login1" placeholder="Номер телефона/E-mail"></li>
										<li><input type="password" id="pass" name="pass1" placeholder="Пароль"></li>
										<li><input type="password" id="pass" name="pass_check" placeholder="Повторите пароль"></li>
										<li><input type="submit" name="button1" value="Зарегистрироваться"></li>
									<li><input type="button" onclick="showlog('1')" value="Вход"></li>
								</form>
							</div>
	     </ul>
    	</div>
     <!-- dropdown end -->
				</li>
			</ul>
			<!-- LOGO START -->
			<div class="logo"><a href=""><img src="img/logo.png" alt="fashion"></a></div>
			<!-- LOGO END -->
			<ul>
				<!-- Приглашения -->
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
	<!-- nav, logo end -->
</header>
<!-- header end -->
<div class="bel-line"></div>
<!-- Internet конкурс start -->
<section class="internet-konk">
	<div class="int-mid">
		<div class="section-title">Интернет конкурс!</div>
		<div class="section-pre-title"><p>Победители конкурса определяются и награждаются на мероприятиях «FashionBuilding» каждый месяц!</p></div>
		<div class="wom-man flex">
			<!-- Картинки девушек start -->
			<div class="left-women-col">
				<div class="woomen-ct"><span>Оцениваем девушек 8)</span></div>
				<div class="thumbnails" style="background-image: url(img/woom.jpg)">
					<div class="thumb n1" style="background-image: url(img/woom.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n2" style="background-image: url(img/woom.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n3" style="background-image: url(img/woom.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n4" style="background-image: url(img/woom.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n5" style="background-image: url(img/woom.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n6" style="background-image: url(img/woom.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n7" style="background-image: url(img/woom.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="large-like"><i class="fa fa-heart"></i></div>
				</div>
			</div>
			<!-- Картинки девушек end -->
			<!-- Картинки мужчин start -->
			<div class="right-man-col">
				 <div class="man-ct"><span class="rot">Оцениваем мужчин :р</span></div>
					<div class="thumbnails" style="background-image: url(img/man.jpg)">

					<div class="thumb n1" style="background-image: url(img/man.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n2" style="background-image: url(img/man.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n3" style="background-image: url(img/man.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n4" style="background-image: url(img/man.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n5" style="background-image: url(img/man.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n6" style="background-image: url(img/man.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="thumb n7" style="background-image: url(img/man.jpg)">
						<div class="like"><i class="fa fa-heart"></i></div>
					</div>
					<div class="large-like"><i class="fa fa-heart"></i></div>
				</div>
			</div>
			<!-- Картинки мужчин start -->
		</div>
		<!-- Смотреть всех, прийнять участие start -->
		<div class="sect-bot-l">
			<ul class="flex space--around">
				<li><a href="#" class="watch-all w">Смотреть всех</a></li>
				<li><a href="#" class="prim">Прими участие!</a></li>
				<li><a href="#" class="watch-all m">Смотреть всех</a></li>
			</ul>
		</div>
		<!-- Смотреть всех, прийнять участие end -->
	</div>
</section>
<!-- Internet конкурс end -->

<section class="date-place">
	<div class="second-big-ttl">
	<!-- Даты и Места проведения -->
	<div class="second-bg-ttl"><span class="fst">Ознакомьтесь с датами</span> <span class="sec">и местами проведения мероприятий :</span></div>
</div>
	<div class="container">
		<div class="block-date">
			<div class="date-t"><span>2016</span> Март 12 пятница</div>
			<div class="date-line">
				<ul>
					<li><span class="day">ПН</span><span class="numb">01</span></li>
					<li><span class="day">ВТ</span><span class="numb">02</span></li>
					<li><span class="day">СР</span><span class="numb">03</span></li>
					<li><span class="day">ЧТ</span><span class="numb">04</span></li>
					<li><span class="day">ПТ</span><span class="numb">05</span></li>
					<li class="red"><span class="day">СБ</span><span class="numb">06</span></li>
					<li><span class="day">ВС</span><span class="numb">07</span></li>
					<li><span class="day">ПН</span><span class="numb">08</span></li>
					<li><span class="day">ВТ</span><span class="numb">09</span></li>
					<li><span class="day">СР</span><span class="numb">10</span></li>
					<li><span class="day">ЧТ</span><span class="numb">11</span></li>
					<li class="red"><span class="day">ПТ</span><span class="numb">12</span></li>
					<li><span class="day">СБ</span><span class="numb">13</span></li>
					<li><span class="day">ВС</span><span class="numb">14</span></li>
					<li><span class="day">ПН</span><span class="numb">15</span></li>
					<li><span class="day">ВТ</span><span class="numb">16</span></li>
					<li><span class="day">СР</span><span class="numb">17</span></li>
					<li><span class="day">ЧТ</span><span class="numb">18</span></li>
					<li class="red"><span class="day">ПТ</span><span class="numb">19</span></li>
					<li class="red"><span class="day">СБ</span><span class="numb">20</span></li>
					<li class="red"><span class="day">ВС</span><span class="numb">21</span></li>
					<li><span class="day">Пн</span><span class="numb">22</span></li>
				</ul>
				<!-- стрелочки влево, вправо -->
				<div class="left"></div>
				<div class="right"></div>
				<!-- стрелочки влево, вправо -->
			</div>
			<!-- Пляж, Лекция, конкурс, Нажиралово -->
			<div class="line-desc flex space--around">
				<div class="line-item li1">
					<div class="name">Пляж</div>
					<div class="desc">с 10:00 до 22:00 описание</div>
				</div>
				<div class="line-item li2">
					<div class="name">Лекция</div>
					<div class="desc">с 15:00 до 20:00 описание</div>
				</div>
				<div class="line-item li3">
					<div class="name">Конкурс</div>
					<div class="desc">с 16:00 до 00:00 описание</div>
				</div>
				<div class="line-item li4">
					<div class="name">Нажиралово</div>
					<div class="desc">с 23:00 до 07:00 описание</div>
				</div>
			</div>
			<!-- Пляж, Лекция, конкурс, Нажиралово -->
			<div class="sec-line flex space--between">
				<!-- Афиша конкурса -->
				<div class="afisha">Афиша конкурса</div>
				<!-- Стоимость билета -->
				<div class="price">
					<div class="stoim-wrap">
						<div class="stoim">Стоимость билета:</div>
						<span class="lp">600р.</span>
						<span class="np">400р.</span>
						<div class="buynow">Приобрести</div>
				</div>
				<div class="oplatit">
					<div class="main-opl">
						<div class="stoim">Стоимость билета:</div>
						<span class="lp">600р.</span>
						<span class="np">400р.</span>
						<div class="col-vo">Количество билетов: <span class="less">-</span>  <span class="count">2</span>  <span class="more">+</span></div>
						<div class="summ">Сумма к оплате: <span class="numb">800</span> р.</div>
						<div class="sposob flex space--between">
							<div class="spos-opl">
								<h3>Способ оплаты:</h3>
								<form action="">
									<ul>
										<li><input type="radio" name="opl" class="rad" value="bank-card" id="bank-card"><label for="bank-card">Банковская карта</label></li>
										<li><input type="radio" name="opl" class="rad" value="qiwi" id="qiwi"><label for="qiwi">Qiwi кошелек</label></li>
										<li><input type="radio" name="opl" class="rad" value="yam" id="yam"><label for="yam">Яндекс Деньги</label></li>
										<li><input type="radio" name="opl" class="rad" value="mob" id="mob"><label for="mob">Баланс мобильного</label></li>
									</ul>
								</form>
							</div>
							<a href="#" class="subm">Оплата</a>
						</div>
						<p class="after">После оплаты Вы получите смс с кодом электронного билета.Для прохода на мероприятие Вам нужно будет показать кодбилетеру мероприятия. Так же код будет доступен Вам в разделе «Приглашения»</p>
					</div>
					<div class="svernut">Свернуть</div>
				</div>
			</div>
			</div>
		</div>
		<div class="block-desc">
			<p class="desssc">Описание мероприятия Текст</p>
			<div class="video-block">Видео</div>
			<a href="#" class="comments">Комментарии</a>
			<div class="end-line"></div>
		</div>
		<div class="thumb-block flex space--between">
			<a href="#" class="thumb" style="background-image: url(img/thumb-unit.jpg)"></a>
			<a href="#" class="thumb" style="background-image: url(img/thumb-unit.jpg)"></a>
			<a href="#" class="thumb" style="background-image: url(img/thumb-unit.jpg)"></a>
			<a href="#" class="thumb" style="background-image: url(img/thumb-unit.jpg)"></a>
			<a href="#" class="thumb" style="background-image: url(img/thumb-unit.jpg)"></a>
			<a href="#" class="thumb" style="background-image: url(img/thumb-unit.jpg)"></a>
			<a href="#" class="thumb" style="background-image: url(img/thumb-unit.jpg)"></a>
			<a href="#" class="thumb" style="background-image: url(img/thumb-unit.jpg)"></a>
		</div>
		<div class="subscribe flex space--between">
			<p class="text">Оставьте свой номер телефона, чтобы получать смс уведомления за несколько дней до начала мероприятий</p>
			<div class="sub-block flex">
				<input type="tel" class="login">
				<input type="button" value="Ок">
			</div>
		</div>
	</div>
</section>

<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="js/app.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/jquery.inputmask.js"></script>
    <script>
	function showlog(val){
		if (val==1){
			document.getElementById('log').style.display="block";
			document.getElementById('register').style.display="none";
		}else{
			document.getElementById('log').style.display="none";
			document.getElementById('register').style.display="block";
		}
	}
	$(document).ready(function() {
	$(".login").inputmask("+7(999)-999-99-99",{ "placeholder": "_" });
   });
	</script>
</body>
</html>
