<?php
require_once("main_php/conect.php");
$kick='1';
if (isset($_COOKIE['id'])){
	$id=$_COOKIE['id'];
	$query="SELECT `hash` FROM `log` WHERE `user_id` LIKE '".$id."'" ;
	if($result = $mysqli->query($query)) {
		while($obj = $result->fetch_object()){
			if((!hash_equals($obj->hash,$_COOKIE['h']))||(hash_equals($obj->hash,crypt($_SERVER['REMOTE_ADDR'],$obj->hash)))){
				$query="SELECT * FROM `profile` WHERE user_id LIKE '".$id."' " ;
				if($result=$mysqli->query($query)){
					while($obj=$result->fetch_object()){
						$name=filter($obj->name);
						$email=filter($obj->mail);
					}
				}
				$query="SELECT * FROM `log` WHERE user_id LIKE '".$id."' " ;
				if($result=$mysqli->query($query)){
					while($obj=$result->fetch_object()){
						$phone=filter($obj->login);
					}
				}
				$kick='0';
			}
		}
	}
}
if ((isset($_POST['button1']))||($kick=='1')){
	header("Location:main_php/clear.php");
}
if (isset($_POST['button5'])){
	if (($_POST['pass1']!="")&&($_POST['pass1']==$_POST['pass_check'])){
		$pass0=filter($_POST['pass0']);
		$chk='0';
		$query="SELECT `pass` FROM `log` WHERE `user_id` LIKE '".$id."'" ;
		if($result = $mysqli->query($query)) {
			while($obj = $result->fetch_object()){
				if(hash_equals($obj->pass, crypt($pass0, $obj->pass))){
					$chk='1';
				}
			}
		}
		if ($chk=='1'){
		$pass1= filter($_POST['pass1']);
		$pass1 = crypt($pass1,gen_salt());
		if(!$mysqli->query("UPDATE `log` SET `pass`='{$pass1}' WHERE `log`.`user_id` ='{$id}'")){
			print "Не удалось создать таблицу: (" . $mysqli->errno . ") " . $mysqli->error;
		}
	}else{
		alert("Неверный старый пароль");
		}
	}else{
		alert("Пароли не совпадают или не все данные введены");
	}
}
if (isset($_POST['button4'])){
	if (($_POST['name']!="")&&($_POST['phone']!="")&&($_POST['email']!="")){
	$brk='0';
	$name=filter($_POST['name']);
	$phone=filter($_POST['phone']);
	$email=filter($_POST['email']);
	$phone = preg_replace('/[^0-9]/', '', $phone);
	$phone = substr($phone,1);
	$query=("SELECT * FROM `profile` WHERE user_id LIKE '".$id."'");
	if($result=$mysqli->query($query)){
		while($obj=$result->fetch_object()){
			if($obj->user_id==$id){
				$brk='1';
				if(!$mysqli->query("UPDATE `profile` SET `name`='{$name}',`mail`=	'{$email}' WHERE `profile`.`user_id` ='{$id}'")){
					print "Не удалось создать таблицу: (" . $mysqli->errno . ") " . $mysqli->error;
				}
				if(!$mysqli->query("UPDATE `log` SET `login`='{$phone}' WHERE `log`.`user_id` ='{$id}'")){
					print "Не удалось создать таблицу: (" . $mysqli->errno . ") " . $mysqli->error;
				}
			}
		}
	}
	if($brk=='0'){
		if(!$mysqli->query("CREATE TABLE IF NOT EXISTS profile(user_id INT, name TEXT,mail TEXT,contest BOOLEAN)") ||
		!$mysqli->query("INSERT INTO profile VALUES('{$id}', '{$name}' , '{$email}' , '0' )")) {
		print "Не удалось создать таблицу: (" . $mysqli->errno . ") " . $mysqli->error;
			}
	}
}else{
	alert("Введите все данные");
}
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
            <div class="logo"><a href=""><img src="img/logo.png" alt="fashion"></a></div>
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
	<div class="overlay" id="overlay" style="display:none;"></div>
	<div class="modal" id="red" style="display:none">
		<span class="close" onclick="showred(0)">X</span>
				<form method="POST">
					<span class="form-group">
					<input type="text" name="name" placeholder="Ваше Имя **"  value="<?php echo $name;?>"/>
					<input type="text"  id="phonee" name="phone" placeholder="Телефон **"  value="<?php echo $phone;?>"/>
					<input type="text" id="email" name="email" placeholder="Электронная почта"  value="<?php echo $email;?>"/>
					<br>
					<br>
					<button type="submit" class="button-form" name="button4">Соханить</button>
					</span>
				</form>
				<br>
	</div>
	<div class="modal" id="passs" style="display:none">
		<span class="close" onclick="showred(2)">X</span>
				<form method="POST">
					<span class="form-group">
						<input type="password" id="pass" name="pass0" placeholder="Старый пароль">
						<input type="password" id="pass" name="pass1" placeholder="Новый пароль">
						<input type="password" id="pass" name="pass_check" placeholder="Повторите пароль">
					<br>
					<br>
					<button type="submit" class="button-form" name="button5">Соханить</button>
					</span>
				</form>
				<br>
	</div>
     <div class="poster">
        <div class="left">
            <h1>Ваши данные</h1>
            <span onclick="showred(1)" class="button-link"><h3>Редактировать</h3></span>
            <p>Имя:<?php echo $name;?><br>Номер телефона:<?php echo phonable($phone)?><span style="display:none">Отсутствует!<br>Прияжите номер телефона для<br>получения электронных билетов<br> и смс уведомлений<br></span><br> E-mail:<?php echo $email?><span style="display:none">Отсутствует!<br>Привяжите для получения<br>уведомлений на электронную<br> почту! </span><br>Пароль:<button onclick="showred(3);">Сменить пароль</button><br><a href="main_php/clear.php"><h3>Выход</h3></span></p>
        </div>
        <div class="right">
            <h1>Привязать аккаунты из соц сете<br>для быстрого входа</h1>
            <a href="#">Тут логотипы соц сетей</a>
            <h2>Найстройка уведомлений</h2>
            <p><input type="checkbox"/>  Я согласен(а) получать смс уведомления<br> от портала «FashionBuilding» раз в неделю</p>
        </div>
    </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="js/jquery.inputmask.js"></script>
    <script>
	function showred(val){
		if (val==1){
			document.getElementById('red').style.display="block";
			document.getElementById('overlay').style.display="block";
		}else if (val==0){
			document.getElementById('red').style.display="none";
			document.getElementById('overlay').style.display="none";
		}else if(val==3){
			document.getElementById('passs').style.display="block";
			document.getElementById('overlay').style.display="block";
		}else{
			document.getElementById('passs').style.display="none";
			document.getElementById('overlay').style.display="none";
		}
	}
	$(document).ready(function() {
		$("#phonee").inputmask("+7(999)-999-99-99",{ "placeholder": "_" });
   });
	</script>
</section>
</body>
</html>
