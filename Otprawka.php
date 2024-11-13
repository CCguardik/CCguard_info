<?php
    //session_start();
?>
   <form method="POST" action="" enctype="">
   <span class="span1">Имя:<input class="input1" type="text" placeholder="Имя" name="name" /></span><br>
   <span class="span2">Фамилия: <input class="input2" type="text" placeholder="Фамилия" name="surname" /></span><br>
   <span class="span3">Отчество:<input class="input3" type="text" placeholder="Отчество" name="father" /></span><br>
   <span class="span4">Название организации:<input class="input4" type="text" placeholder="Название организации" name="organization" /></span><br>
   <span class="span5">Контактный номер:<input class="input5"type="text" placeholder="Контактный номер" name="number"/></span><br>
   <span class="span6">E-mail:<input class="input6" type="text" placeholder="E-mail" name="email" /></span><br>
   <span class="span7">Краткое описание<br /> вашего предложения</span><br>
   <textarea class="ta1" name="text1" cols="18" rows="8"></textarea><br>
   <span class="span8">Более детальное<br /> описание<br />(не обязательно)</span><br>
   <textarea class="ta2" name="text2" cols="18" rows="8"></textarea><br>
    <?php/*
        $a = rand(1,9);
        $b = rand(1,9);
        $_SESSION['res'] = $a + $b;
        echo '<b>'.$a.'+'.$b.'</b><br>';
        echo '<p>Введите ответ</p>';*/
    ?>
   <!--input type="text" name="res"><br-->
   <input type="reset" class="submit1" value="сброс" /><br>
   <input type="submit" class="submit2" name="ok" value="отправить" /><br>
</form>
<?php
    $domain = $_SERVER['HTTP_HOST'];
    if(isset($_POST['ok']))
    {
        //Идет проверка на заполнение полей
        if(empty($_POST['name'])) echo 'Вы не ввели имя ';
        if(empty($_POST['surname'])) echo 'Вы не ввели фамилию ';
        if(empty($_POST['father'])) echo 'Вы не ввели Отчество ';
        if(empty($_POST['organization'])) echo 'Вы не ввели название оргонизации ';
        if(empty($_POST['number'])) echo 'Вы не ввели контактный номер ';
        if(empty($_POST['email'])) echo 'Вы не указали email ';
        if(empty($_POST['text1'])) echo 'Вы не написали свое предложение ';
        //if(empty($_POST['res'])) echo 'Вы не вели ответ';
        else{
            //Идет присваивание значений
            $name = mysql_real_escape_string($_POST['name']);
            $surname = mysql_real_escape_string($_POST['surname']);
            $father = mysql_real_escape_string($_POST['father']);
            $organization = mysql_real_escape_string($_POST['organization']);
            $number = mysql_real_escape_string($_POST['number']);
            $email = mysql_real_escape_string($_POST['email']);
            $text1 = mysql_real_escape_string($_POST['text1']);
            $text2 = mysql_real_escape_string($_POST['text2']);
            //$res = mysql_real_escape_string($_POST['res']);
                //Проверка на  правильность заполнение emaila так же можно произвести проверки на другие необходимые поля
                if(!preg_match('/^[-0-9a-z_.]+@[-0-9a-z^.]+.[a-z]{2,4}$/i',$email))
                    exit ('Вы не коректно указали емайл');
                else
                    /*if($res == $_SESSION['res'])
                        exit('Вы не верно дали ответ');
                    else*/
                        $address = 'Ваш адрес электронной почты';//[B]Внимательно смотрим сюда[/B]
                        $sub = "Сообщение с сайта $domain";
                        $mes = "Посетитель назвался: $surname, $name, $father \r\n Указал свою организацию: $organization \r\n Указал свой номер: $number \r\n Указал свой адрес: $email \r\n Содержание письма:$text1, \r\n $text2";
                        $utf = "Content-type:text/plain; charset = utf-8";
                        
                        if(mail($address,$sub,$mes,$utf)){
                            echo "<p>Сообщение отправленно успешно,Спасибо!</p>";
                        }else{
                            echo "<p>Сообщение не удалось отправить,повторите попытку позже!!!</p>";
                        }   
            }           
    }
?>