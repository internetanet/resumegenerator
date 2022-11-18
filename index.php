<?php
header('Content-Type: text/html; charset = utf-8');
error_reporting(E_ALL);
mb_internal_encoding("UTF-8");

//вывод уведомлений
function notification($msg, $param = 2) {
  if ($param == 1) {
    $show = '<div class="message-green"><span class="message-text">'.$msg.'</span></div>';//зеленый фон. успешн.
  }
  elseif ($param == 0) {
    $show = '<div class="message-red"><span class="message-text">'.$msg.'</span></div>';//красный фон. ошибка
  }
  else{
    $show = '<div class="message-blue"><span class="message-text">'.$msg.'</span></div>';//синий фон. информация
  }
  echo $show.'<br>';
}
//
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">

<noscript><div><img src="https://mc.yandex.ru/watch/67703959" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
  <title>Генератор резюме</title>
  <style>
@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
html,body{
  width: 100%;
  font-family: 'Ubuntu', sans-serif;
  margin: 0;
  padding: 0;
  background: #EDEEF0;
}
/*стили функции вывода уведомлений*/
.message-green{
  display: flex;
  width: 600px;
  background: #D4E5D0;
  border-radius: 5px;
  border: 1px solid #52B231;
  margin: 15px 0 0 0;
  padding: 15px;
}
.message-red{
  display: flex;
  width: 600px;
  background: #FAEAEA;
  border-radius: 5px;
  border: 1px solid #DD4F43;
  margin: 15px 0 0 0;
  padding: 15px;
}
.message-blue{
  display: flex;
  width: 600px;
  background: #E5EEF9;
  border-radius: 5px;
  border: 1px solid #509CC0;
  margin: 15px 0 0 0;
  padding: 15px;
}
.message-text{
  color: black;
  margin: auto;
  text-align: center;
}
/*стили функции вывода уведомлений*/

.wrap{/*оболочка страницы*/
  display: flex;
  flex-direction: column;
  /*justify-content: center;*/
  align-items: center;
}
form{/*свойства формы*/
  display: flex;
  flex-direction: column;
  /*justify-content: center;*/
  align-items: center;
  background: #FFFFFF;
  width: auto;
  margin: 30px;
  padding: 30px;
  border: solid 1px #E7E8EC;
  border-radius: 4px;
}
.input-control{/*оболочка label и input*/
  display: block;
  width: auto;
}
.form-control{/*свойства для input text*/
  display: block;
  margin: 5px 0 0 0;
  width: 500px;
  height: 35px;
  border: solid #498AF4 1px;
  border-radius: 4px;
  padding: 6px 12px;
  font-size: 14px;
  font-family: 'Ubuntu', sans-serif;
}
.form-control:focus{/*свойства для input text*/
  border: solid 1px #FF9800;
  border-radius: 4px;
  outline: none;
}
.form-control-names{
  width: 265px;
}
.names-photo{ /*три инпута ФИО и фото*/
  display: flex;
  justify-content: flex-start;
  width: auto;
  padding: 0;
  margin: 0;
}
img{
  width: 170px;
  height: 170px;
  margin: 22px 0 0 65px;
}
.photo-block{
  display: flex;
  flex-direction: column;
}

.btn{/*свойства кнопок #498AF4*/
  margin: 10px 0 20px;
  background:  #498AF4;
  width: 200px;
  height: 35px;
  border: solid 1px #498AF4;
  border-radius: 4px;
  cursor: pointer;
  padding: 6px 12px;
  font-size: 12px;
}
.btn:hover{
  background: #8DA2B9;
}
.text-danger{
  color: #a94442;
  font-family: 'Ubuntu', sans-serif;
}
</style>
</head>
<body>

<div class="wrap">

<?php
//////////////определение переменных на полученные с формы данные, фильтруем
$usersurname = (isset($_POST['surname'])) ? htmlspecialchars(trim($_POST['surname'])) : ''; //фамилия
$username = (isset($_POST['name'])) ? htmlspecialchars(trim($_POST['name'])) : ''; //имя
$patronymic = (isset($_POST['patronymic'])) ? htmlspecialchars(trim($_POST['patronymic'])) : ''; //отчество
$birthday = (isset($_POST['birthday'])) ? htmlspecialchars(trim($_POST['birthday'])) : ''; //дата рождения
$email = (isset($_POST['email'])) ? htmlspecialchars(trim($_POST['email'])) : ''; //почта
$phone = (isset($_POST['phone'])) ? htmlspecialchars(trim($_POST['phone'])) : ''; //телефон
$registration_address = (isset($_POST['registration_address'])) ? htmlspecialchars(trim($_POST['registration_address'])) : ''; //адрес прописки
$actual_address = (isset($_POST['actual_address'])) ? htmlspecialchars(trim($_POST['actual_address'])) : ''; //фактический адрес
$position = (isset($_POST['position'])) ? htmlspecialchars(trim($_POST['position'])) : ''; //желаемая должность
$work_experience = (isset($_POST['work_experience'])) ? htmlspecialchars(trim($_POST['work_experience'])) : ''; //опыт работы
$wage = (isset($_POST['wage'])) ? htmlspecialchars(trim($_POST['wage'])) : ''; //желаемая зарплата
$education_institution = (isset($_POST['education_institution'])) ? htmlspecialchars(trim($_POST['education_institution'])) : ''; //учебное завведение
$education_year = (isset($_POST['education_year'])) ? htmlspecialchars(trim($_POST['education_year'])) : ''; //год выпуска
$previous_employment1 = (isset($_POST['previous_employment1'])) ? htmlspecialchars(trim($_POST['previous_employment1'])) : ''; //предыдущее место работы1
$previous_employment2 = (isset($_POST['previous_employment2'])) ? htmlspecialchars(trim($_POST['previous_employment2'])) : ''; //предыдущее место работы2
$email_to = (isset($_POST['email_to'])) ? htmlspecialchars(trim($_POST['email_to'])) : ''; //почтовый адрес, куда нужно отправить резюме

//проверка введенных данных
  if (isset($_POST['submit'])) {
    if(empty($_POST['surname']) || empty($_POST['name']) || empty($_POST['birthday']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['registration_address']) || empty($_POST['actual_address']) || empty($_POST['position']) || empty($_POST['work_experience']) || empty($_POST['education_institution']) || empty($_POST['education_year']) || empty($_POST['email_to'])) {
      $param = 0;
      $message = 'Пожалуйста, заполните все обязательные поля!';
    }
    elseif(!empty($_POST['surname']) || !empty($_POST['name']) || !empty($_POST['birthday']) || !empty($_POST['email']) || !empty($_POST['phone']) || !empty($_POST['registration_address']) || !empty($_POST['actual_address']) || !empty($_POST['position']) || !empty($_POST['work_experience']) || !empty($_POST['education_institution']) || !empty($_POST['education_year']) || !empty($_POST['email_to'])) {
      
      ///////////////////////////////////////////////////////тут происходит конвертация html в pdf
      $apikey = 'd94bfe4364edfa4e1bf2f243412cc9dd';
      $value = '<h1 style="text-align: center">Резюме</h1>
                <br>
                <br>

                <div style="float:left;" align="left">Фамилия: </div>
                <div style="float:right;" align="right">'.$usersurname.'</div><br><br>

                <div style="float:left;" align="left">Имя: </div>
                <div style="float:right;" align="right">'.$username.'</div><br><br>

                <div style="float:left;" align="left">Отчество: </div>
                <div style="float:right;" align="right">'.$patronymic.'</div><br><br>

                <div style="float:left;" align="left">Дата рождения: </div>
                <div style="float:right;" align="right">'.$birthday.'</div><br><br>

                <div style="float:left;" align="left">Электронная почта: </div>
                <div style="float:right;" align="right">'.$email.'</div><br><br>

                <div style="float:left;" align="left">Телефон: </div>
                <div style="float:right;" align="right">'.$phone.'</div><br><br>

                <div style="float:left;" align="left">Адрес прописки: </div>
                <div style="float:right;" align="right">'.$registration_address.'</div><br><br>

                <div style="float:left;" align="left">Фактический адрес проживания: </div>
                <div style="float:right;" align="right">'.$actual_address.'</div><br><br>

                <div style="float:left;" align="left">Желаемая должность: </div>
                <div style="float:right;" align="right">'.$position.'</div><br><br>

                <div style="float:left;" align="left">Опыт работы в данной должности: </div>
                <div style="float:right;" align="right">'.$work_experience.' лет</div><br><br>

                <div style="float:left;" align="left">Желаемая зарплата (руб): </div>
                <div style="float:right;" align="right">'.$wage.'</div><br><br>

                <div style="float:left;" align="left">Учебное заведение: </div>
                <div style="float:right;" align="right">'.$education_institution.'</div><br><br>

                <div style="float:left;" align="left">Год выпуска: </div>
                <div style="float:right;" align="right">'.$education_year.' г.</div></div><br><br>

                <div style="float:left;" align="left">Предыдущее место работы: </div>
                <div style="float:right;" align="right">'.$previous_employment1.'</div><br>
                <div style="float:right;" align="right">'.$previous_employment2.'</div>
      ';

$postdata = http_build_query(
    array(
        'apikey' => $apikey,
        'value' => $value,
        'MarginTop' => '30',
        'MarginBottom' => '30',
        'MarginLeft' => '30',
        'MarginRight' => '30',
        'LowQuality' => 'true',
        'FileName' => 'resume.pdf'
    )
);
 
$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);
 
$context  = stream_context_create($opts);
 
//Преобразование HTML в PDF посредством отправки данных методом POST в API с параметрами
$result = file_get_contents('http://api.pdf4b.ru/pdf', false, $context);
 
//Сохраняем полученный файл на сервере
file_put_contents('resume.pdf', $result);
/////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////далее формируем и отправляем письмо
function kmail( $from, $to, $subj, $text, $filename) {
$f = fopen($filename,"rb");
$un = strtoupper(uniqid(time()));
$head = "From: $from\n";
$head .= "To: $to\n";
$head .= "Subject: $subj\n";
$head .= "Reply-To: $from\n";
$head .= "Mime-Version: 1.0\n";
$head .= "Content-Type:multipart/mixed;";
$head .= "boundary=\"----------".$un."\"\n\n";
$zag = "------------".$un."\nContent-Type:text/html;\n";
$zag .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
$zag .= "------------".$un."\n";
$zag .= "Content-Type: application/octet-stream;";
$zag .= "name=\"".basename($filename)."\"\n";
$zag .= "Content-Transfer-Encoding:base64\n";
$zag .= "Content-Disposition:attachment;";
$zag .= "filename=\"".basename($filename)."\"\n\n";
$zag .= chunk_split(base64_encode(fread($f,filesize($filename))))."\n";
 
return mail($to ,$subj, $zag, $head);
}


//от кого почта
$from = 'Робот';
// для кого почта
$to = $email_to;
// заголовок письма
$title = 'Резюме на должность "'.$position.'" '.$usersurname.' '.$username.' '.$patronymic;//тема письма
// текст письма
$text = 'Это автосообщение, отвечать на него не нужно.';//текст сообщения
// файл вложения
$file = "resume.pdf";//отправляемый файл

kmail ( $from, $to, $title, $text, $file);

      $param = 1;
      $message = 'Ваше резюме успешно создано и отправлено по указанному адресу! <br><a href="resume.pdf" download>Скачать резюме</a>.';
    }
  }
  else{
    $param = 2;
    $message = 'У нас вы можете быстро составить и отправить резюме потенциальному работодалю! Пожалуйста, внимательно заполните все поля и нажмите кнопку "Создать и отправить". Помните: чем подробнее вы заполните ваше резюме - тем выше вероятность того, что вакантное место будет вашим!';
  }
  notification($message, $param);
//////////////////////////////ниже идет код формы отправки
?>

<form method="POST" enctype="multipart/form-data">
  <h2>Генератор резюме</h2>
    <div class="input-control">
        <label  class="form-text" for="input-surname">Фамилия <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
        <input type="text" class="form-control" name="surname" id="input-surname" placeholder="Иванов" pattern="[А-Яа-яЁё]{2,25}" maxlength="25" value="<?= $usersurname?>"><br><!-- фамилия -->
    </div>
    <div class="input-control">
        <label  class="form-text" for="input-name">Имя <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
        <input type="text" class="form-control" name="name" id="input-name" placeholder="Иван" pattern="[А-Яа-яЁё]{2,25}" maxlength="25" value="<?= $username?>"><br><!-- имя -->
    </div>
    <div class="input-control">
        <label  class="form-text" for="input-patronymic">Отчество</label>
       <input type="text" class="form-control" name="patronymic" id="input-patronymic" placeholder="Иванович" pattern="[А-Яа-яЁё]{2,25}" maxlength="25" value="<?= $patronymic?>"><br><!-- отчество -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-birthday">Дата рождения <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
      <input type="date" class="form-control" name="birthday" id="input-birthday" maxlength="10" value="<?= $birthday?>"><br><!-- дата рождения -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-email">Электронная почта <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
      <input type="email" class="form-control" name="email" id="input-email" placeholder="Пример: ivan@mail.ru" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" maxlength="50" value="<?= $email?>"><br><!-- адрес эл. почты -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-phone">Телефон <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
      <input type="tel" class="form-control" name="phone" id="input-phone" placeholder="11 цифр, начиная с 8-ки, пример: 89008007060" title="11 цифр, начиная с 8" pattern="8([0-9]{10})" maxlength="11" value="<?= $phone?>"><br><!-- телефон -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-registration_address">Адрес прописки <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
      <input type="text" class="form-control" name="registration_address" id="input-registration_address" title="Формат: г. Москва, ул. Московская 1, кв.1" value="<?= $registration_address?>"><br><!-- адрес по прописке -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-actual_address">Фактический адрес проживания <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
      <input type="text" class="form-control" name="actual_address" id="input-actual_address" title="Формат: г. Москва, ул. Московская 1, кв.1" value="<?= $actual_address?>"><br><!-- фактический адрес проживания -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-position">Желаемая должность <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
      <input type="text" class="form-control" name="position" id="input-position" placeholder="Бухгалтер" title="Пример: PHP-программист" pattern="([A-Za-zА-Яа-яЁё\s\.\-]{2,50})" maxlength="70" value="<?= $position?>"><br><!-- желаемая должность -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-work_experience">Опыт работы в данной должности (лет) <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
      <input type="text" class="form-control" name="work_experience" id="input-work_experience" placeholder="10" title="Формат: цифры от 1 до 99" pattern="[0-9]{1,2}" maxlength="2" value="<?= $work_experience?>"><br><!-- опыт работы -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-wage">Желаемая зарплата (руб.)</label>
      <input type="text" class="form-control" name="wage" id="input-wage" placeholder="40000" pattern="[0-9]{1,8}" maxlength="8" value="<?= $wage?>"><br><!-- желаемая зарплата -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-education_institution">Учебное заведение <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
      <input type="text" class="form-control" name="education_institution" id="input-education_institution" placeholder="МГУ им. М. В. Ломоносова" maxlength="50" value="<?= $education_institution?>"><br><!-- учебное заведение -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-education_year">Год выпуска <small class="text-danger" style="font-weight: 500;">(обязательно)</small></label>
      <input type="text" class="form-control" name="education_year" id="input-education_year" placeholder="1994" pattern="[0-9]{4,4}" maxlength="4" value="<?= $education_year?>"><br><!-- год выпуска -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-previous_employment1">Предыдущее место работы</label>
      <input type="text" class="form-control" name="previous_employment1" id="input-previous_employment1" placeholder="ПАО Сбербанк" pattern="([A-Za-zА-Яа-яЁё\s\.\-]{1,50})" maxlength="40" value="<?= $previous_employment1?>"><br><!-- предыдущее место работы -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-previous_employment2">По желанию, укажите ещё одно место работы</label>
      <input type="text" class="form-control" name="previous_employment2" id="input-previous_employment2" placeholder="ОАО Банкомат" pattern="([A-Za-zА-Яа-яЁё\s\.\-]{1,50})" maxlength="40" value="<?= $previous_employment2?>"><br><!-- предыдущее место работы -->
    </div>
    <div class="input-control">
      <label  class="form-text" for="input-email_to">Электронная почта работодателя <small class="text-danger" style="font-weight: 500;">(обязательно, для отправки резюме)</small></label>
      <input type="email" class="form-control" name="email_to" id="input-email_to" placeholder="Пример: rabota@mail.ru" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" maxlength="20" value="<?= $email_to?>"><br><!-- адрес эл. почты -->
    </div>

    <input class="btn" type="submit" name="submit" value="Создать и отправить">
  
</form>

</div>
</body>
</html>
