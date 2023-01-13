<html lang="ru">
<head>
    <meta charset="unicode"> 
   <!--  <meta charset="UTF-8">  -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab 9</title>
    <style>
        *{
            font-size: medium;
            font-weight: bolder;
            font-family: calibri;
            margin: 3px;
            padding: 2px;
            background-color: bisque;
        }
        .correct {
            background-color: green;
        }
        .wrong {
            background-color: red;
        }
    </style>
</head>
<body>
    <?php
        $months = [1 => 'Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь'];
        $daysoftheWeek = ["воскресенье", "понедельник", "вторник", "среда", "четверг", "пятница", "суббота"];

        function dels($n)
        {
            $result = [];
            for ($i = 1; $i <= $n; $i++) if ($n % $i == 0) array_push($result, $i);
            return $result;
        }

        function GetZodiac($month, $day)
        {
            switch ($month)
            {
                case "01": return $day <= 20 ? "Козерог" : "Водолей"; break;
                case "02": return $day <= 19 ? "Водолей" : "Рыбы"; break;
                case "03": return $day <= 20 ? "Рыбы" : "Овен"; break;
                case "04": return $day <= 20 ? "Овен" : "Телец"; break;
                case "05": return $day <= 21 ? "Телец" : "Близнецы"; break;
                case "06": return $day <= 21 ? "Близнецы" : "Рак"; break;
                case "07": return $day <= 22 ? "Рак" : "Лев"; break;
                case "08": return $day <= 23 ? "Лев" : "Дева"; break;
                case "09": return $day <= 23 ? "Дева" : "Весы"; break;
                case "10": return $day <= 23 ? "Весы" : "Скорпион"; break;
                case "11": return $day <= 22 ? "Скорпион" : "Стрелец"; break;
                case "12": return $day <= 23 ? "Стрелец" : "Козерог"; break;   
            }
        }
    ?>
    
    <p>1.  По заходу на страницу выведите сколько дней осталось до нового года<br>
        <?php
            $newyear = floor(strtotime("1.01.2024")/86400);
            $currantDate = date("d.m.y");
            $result = $newyear - floor(strtotime($currantDate)/86400);
            echo "Сегодня $currantDate, до нового года осталось дней: $result ";
        ?>
    </p>
    
    <p>2.  По нажатию на кнопку выведите на экран, високосный он или нет<br>
        <form method="post">
            <input type="text" name="year">
            <input type="submit">
        </form>
        <?php
            if (isset($_POST['year'])) {
                $year = $_POST['year'];
                echo ($year % 4 == 0 && $year % 100 != 0 || $year % 400 == 0) ? $year . ' год  - високосный!': $year . ' год - невисокосный!';
            }
        ?>
    </p>

    <p>3.  Выведите на экран день недели, соответствующий этой дате, например, 'воскресенье'<br>
        <form  method="post">
            <input type="text" name="date" >
            <input type="submit"/>
        </form>
        <?php
            if (isset($_REQUEST['date'])) {
                $date = explode('.', $_REQUEST['date']);
                echo $_REQUEST['date']." - ".$daysoftheWeek[date('w', mktime(0, 0, 0, $date[1], $date[0], $date[2]))];
            }
        ?>
    </p>

    <p>4.	По заходу на страницу выведите текущую дату в формате '12 мая 2015 года, воскресенье'<br>
    <?php echo date( 'd ' . $months[date( 'n' )] . ' Y, ' . $daysoftheWeek[date( 'w')]); ?> </p>

    <p>5.   В инпут вводится дата рождения в формате '01.12.1990'. По нажатию на кнопку выведите на экран сколько дней осталось до дня рождения пользователя<br>
        <form method="post">
            <input type="text" name="date4" >
            <input type="submit">
        </form>
        <?php
            if (isset($_POST['date4'])) {
                $date4 = explode('.', $_POST['date4']);
                $now = time();
                $birthDay = mktime(23, 59, 59, $date4[1], $date4[0]) + 1;
                if ($birthDay > $now) echo "Осталось ".floor(($birthDay - $now) / 60 / 60 / 24) . ' дней';
                else echo "Осталось ".floor(($birthDay - $now + 60 * 60 * 24 * 365) / 60 / 60 / 24) . ' дней';
            }
        ?>
    </p>

    <p>6.	По заходу на страницу выведите сколько дней осталось до ближайшей масленницы (последнее воскресенье весны)<br>
        <?php
            $lastSunday = 0;
            $now = time();
            for ($i = 28; $i >= 1; $i--) {
                if (date('w', mktime(0, 0, 0, 2, $i)) == 0) {
                    $lastSunday = mktime(23, 59, 59, 2, $i) + 1;
                    break;
                }
            }
            echo ($lastSunday > $now) ? floor(($lastSunday - $now) / 60 / 60 / 24) . ' дней' : floor(($lastSunday - $now + 60 * 60 * 24 * 365) / 60 / 60 / 24) . ' дней';
        ?>
    </p>

    <p>7.   В этот инпут вводится дата рождения в формате '31.12'. По нажатию на кнопку выведите знак зодиака пользователя<br>
        <form method="post">
            <input type="text" name="date7">
            <input type="submit" >
        </form>
        <?php
            $date7 = $_POST["date7"];
            $date7 = "$date7.2022";
            $day7 = (int)date("d",strtotime($date7));
            $month7 = date("m" ,strtotime($date7));

            echo $_POST["date7"]." - ".GetZodiac($month7, $day7);
        ?>
    </p>

    <p>8.   По заходу на страницу, если сегодня праздник, то поздравьте пользователя с этим праздником<br>
    <?php
        $holidays = [
            "0511" => "День благодарности пончику (National Doughnut Appreciation Day) - США",

            "1301" => "День резинового утёнка (National Rubber Ducky Day) - США",
            "1401" => "День трубопроводных войск Вооруженных Сил России",
        ];
        $date8 = date('dm', time());
        if (array_key_exists($date8, $holidays)) echo "Поздравляю с праздником: ".$holidays[$date8];
        else echo "Никакого праздника сегодня";
        ?>
    </p>

    <p>9.   По заходу на страницу спросите у пользователя дату рождения, определите его знак зодиака и выведите предсказание для этого знака зодиака на текущий день<br>
        <form method="post">
            <input type="text" name="date9" >
            <input type="submit">
        </form>
        <?php
            $date9 = $_POST["date9"];
            $date9 = "$date9.2022";
            $day9 = (int)date("d",strtotime($date9));
            $month9 = date("m" ,strtotime($date9));

            $key9 = GetZodiac($month9, $day9);

            $predictions = [
                "Водолей" => "всё будет хорошо",
                "Рыбы" => "всё будет норм",
                "Овен" => "всё будет ок",
                "Телец" => "всё будет плохо", 
                "Близнецы" => "всё будет хорошо",
                "Рак" => "всё будет норм",
                "Лев" => "всё будет ок",
                "Дева" => "всё будет плохо", 
                "Весы" => "всё будет хорошо",
                "Скорпион" => "всё будет норм",
                "Стрелец" => "всё будет ок",
                "Козерог" => "всё будет плохо", 
            ];

            echo $_POST["date9"]." $key9, $predictions[$key9]";
        ?>
    </p>

    <p>10.  В текстареа вводится текст. По нажатию на кнопку выведите количество слов в тексте, количество символов в тексте, количество символов за вычетом пробелов<br>
        11.  В текстареа вводится текст. По нажатию на кнопку нужно посчитать процентное содержание каждого символа в тексте.<br>
        <form method="post">
            <textarea name = "text10"></textarea>
            <input type="submit">
        </form>
        <?php
            if (!empty($_POST['text10'])) {
                $text = $_POST['text10'];
                $textLength = strlen($text);
                $wordsCount = count(explode(' ', $text));
                $spaceCount = $wordsCount - 1;

                echo 'Слов: '.$wordsCount.', символов: '.$textLength.', символов за вычетом пробелов: '.($textLength - $spaceCount)."<br>";

                $charCount = array_count_values(str_split($text));
                foreach ($charCount as $key => $item) {
                    $x = 100 / $textLength * $item;
                    echo $key.' - '.round($x, 2).'% ';
                }
            }
        ?>
    </p>
    
    <p>12.  В инпут вводится набор букв. По нажатию на кнопку выведите на экран те слова, которые содержат в себе все введенные буквы<br>
        <form method="post">
            <input type="text" name="text12" >
            <input type="submit">
        </form>
        <?php
            $someWords = [
                "some",
                "words",
                "here",
                "ear",
                "era",
                "are",
                "area",
                "read",
                "dear",
            ];
            print_r($someWords); echo "<br>";
            if (isset($_POST['text12'])) {
                $char = str_split(strtolower($_POST['text12']));
                $n = count($char);
                foreach ($someWords as $word) {
                    $isContains = true;
                    for ($i = 0; $i < $n; $i++)  if (!strpbrk($word, $char[$i])) $isContains = false;
                    if ($isContains) echo $word."\n";  
                }
            }
        ?>
    </p>

    <p>13.	В текстареа через пробел вводятся слова. По нажатию на кнопку выведите слова в таком виде: сначала заголовок 'слова на букву а' и под ним все слова, которые начинаются на 'а', потом заголовок 'слова на букву б' и все слова на 'б' и так далее<br>
        <form method="post">
            <textarea name = "text13"></textarea>
            <input type="submit">
        </form>
        <?php
            mb_internal_encoding("UTF-8");
            if (isset($_POST['text13'])) {
                $letters = str_split("abcdefghijklmnopqrstuvwxyzабвгдеёжзийклмнопрстуфхцчшщъыьэюя");
                $words = explode(' ', strtolower($_POST['text13']));
                $allWords = [];
                foreach ($letters as $item) {
                    foreach ($words as $word) {
                        /* $word = mb_strtolower($word); */
                        if (mb_substr($word, 0, 1) == $item) {
                            $allWords[$item][] = $word;
                        }
                    }
                }
                foreach ($allWords as $key => $item2) {
                    echo 'Слова на букву '.$key.':<br>';
                    foreach ($item2 as $subItem)
                        echo $subItem.' ';
                    
                    echo '<br>';
                }
            
            }
        ?>
    </p>

    <p>14.  В инпут вводится строка на русском языке. По нажатию на кнопку выведите на экран транслит этой строки<br>
        15.	В инпут вводится строка, а с помощью радиокнопочек выбирается - нужно преобразовать эту строку в транслит или из транслита обратно.<br>
        <form  method="post">
            <input type="text" name="text15" /><br>
            <input type="radio" name="rb" value="1"> русский -> английский<br>
            <input type="radio" name="englishLetters" value="2"> английский -> русский<br>
            <input type="submit">
        </form>
        <?php
            $russianletters = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'];
            $englishLetters = ['A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya'];
            mb_internal_encoding("UTF-8");
            if (isset($_REQUEST['text15']))
                echo ($_REQUEST['rb'] == 1) ? str_replace($russianletters, $englishLetters, $_POST['text15']) : str_replace($englishLetters, $russianletters, $_POST['text15']);
        ?>
    </p> 

    <p>16.	Реализуйте тест: выведите на экран все вопросы, под каждым инпут. Пользователь читает вопрос, пишет свой ответ в инпут. Когда вопросы заканчиваются - он жмет на кнопку, страница обновляется и вместо инпутов под вопросами появляется сообщение вида: 'ваш ответ: ... верно!' или 'ваш ответ: ... неверно! Правильный ответ: ...'. Правильно отвеченные вопросы должны гореть зеленым цветом, а неправильно - красным.<br>
        <form action="" method="post">
            <?php
                $questions = [
                    "2 + 2" => "4",
                    "2 + 2 * 2" => "6",
                    "2^2" => "4"
                ];

                $i = 0;
                foreach ($questions as $quest => $answer) {
                    echo $quest . "<br>";
                    if (isset($_POST["q$i"])) {
                        echo "<p>Ваш ответ: " . $_POST["q$i"] . " - ";
                        if ($_POST["q$i"] === $answer)
                        echo '<span class = "correct">верно!';
                        else
                        echo '<span class = "wrong">неверно! Правильный ответ: '.$answer;
                        echo "</span></p>";
                    } 
                    else echo '<input type="text" name="q' . $i . '"><br>';
                    $i++;
                }
            ?>
            <input type="submit">
        </form>
    </p>  

    <p>17.	Модифицируем предыдущую задачу: пусть теперь тест показывает варианты ответов и радиокнопочки. Пользователь должен выбрать один и вариантов.<br>
        <form action="" method="post">
            <?php
            
                $questions = [
                    "2 + 2" => "4",
                    "2 + 2 * 2" => "6",
                    "2^2" => "4"
                ];

                $i = 0;
                foreach ($questions as $quest => $answer) {
                    echo $quest . "<br>";
                    if (isset($_POST["radio17$i"])) {
                        echo "<p>Ваш ответ: " . $_POST["radio17$i"] . " - ";
                        if ($_POST["radio17$i"] === $answer)
                        echo '<span class = "correct">верно!';
                        else
                        echo '<span class = "wrong">неверно! Правильный ответ: '.$answer;
                        echo "</span></p>";
                    } else
                        echo '
                        <input type="radio" name="radio17' . $i . '" value="'.$answer.'">
                        <label>'.$answer.'</label>
                        <input type="radio" name="radio17' . $i . '" value=" не '.$answer.'">
                        <label> не '.$answer.'</label>
                        <input type="radio" name="radio17' . $i . '" value="8">
                        <label>8</label>
                        <br>
                        ';

                    $i++;
                }
                ?>
            <input type="submit">
        </form>
    </p>
    
    <p>18.	Модифицируем предыдущую задачу: пусть теперь на один вопрос может быть несколько правильных ответов. Пользователь должен отметить один или несколько чекбоксов.<br>
        <form action="" method="post">
            <?php
                $questions = [
                    "2 + 2" => ["4", "тоже 4"],
                    "2 + 2 * 2" => ["6", "тоже 6"],
                    "2^2" => ["4", "тоже 4"]
                ];

                $variants = [
                    ["4", "6", "8", "тоже 4", "8", "тоже 6"],
                    ["4", "6", "8", "тоже 4", "8", "тоже 6"],
                    ["4", "6", "8", "тоже 4", "8", "тоже 6"],
                ];

                $i = 0;
                foreach ($questions as $quest => $answer) {
                    echo $quest . "<br>";
                    if (isset($_POST["submit"])) {
                        echo "Ваш ответ: [";
                        $userAnswer = [];
                        for ($j = 0; $j < count($variants[$i]); $j++) {
                        if (isset($_POST["radio18$i$j"])) {
                            array_push($userAnswer, $_POST["radio18$i$j"]);
                        }
                        }
                        echo implode(", ", $userAnswer) . "] - ";
                        if (!array_diff($userAnswer, $answer) && !array_diff($answer, $userAnswer))
                        echo '<span class = "correct">верно!';
                        else
                        echo '<span class = "wrong">неверно!';
                        echo "</span></p>";
                    } else {
                        for ($j = 0; $j < count($variants[$i]); $j++)
                        echo '
                            <input type="checkbox" name="radio18' . $i . $j . '" value="' . $variants[$i][$j] . '">
                            <label>' . $variants[$i][$j] . '</label>
                        ';
                        echo "<br>";
                    }
                    $i++;
                }

                if (isset($_POST["reset"])) $_POST["submit"] = "";
            ?>
            <input type="submit" name="submit">
            <input type="submit" name="reset" value="Сброс">
        </form>
    </p>

    <p>19.	Напишите скрипт, который будет считать факториал числа. Само число вводится в инпут и после нажатия на кнопку пользователь должен увидеть результат.<br>
        <form method="post">
            <input type="text" name="text19" />
            <input type="submit" name="but"/>
        </form>
        <?php
           // function fact($n) {return $n == 1? $n : $n * fact($n - 1);}
            function fact($n) {return array_product(range(1, $n));};
            if (isset($_REQUEST['text19'])) echo $_REQUEST['text19']."! = ".fact($_REQUEST['text19']);
        ?>
    </p>

    <p>20.	Напишите скрипт, который будет находить корни квадратного уравнения. Для этого сделайте 3 инпута, в которые будут вводиться коэффициенты уравнения<br>
        <form method="post">
            <label for = "a20">A:</label>
            <input type="text" name="a20">
            <label for = "b20">B:</label>
            <input type="text" name="b20">
            <label for = "c20">C:</label>
            <input type="text" name="c20">
            <input type="submit">
        </form>
        <?php
            if (isset($_POST['a20']) && isset($_POST['b20']) && $_POST['c20']) {
                $a = $_POST['a20'];
                $b = $_POST['b20'];
                $c = $_POST['c20'];
                $d = pow($b, 2) - 4 * $a * $c;
                $x1 = round((-$b + sqrt($d)) / (2 * $a), 2);
                $x2 = round((-$b - sqrt($d)) / (2 * $a), 2);
                echo 'x1 = '.$x1.', x2 = '.$x2;
            }
        ?>
    </p>

    <p>21.	Проверьте, что эти числа являются тройкой Пифагора: квадрат самого большого числа должен быть равен сумме квадратов двух остальных.<br>
        <form method="post">
            <label for = "a21">A:</label>
            <input type="text" name="a21">
            <label for = "b21">B:</label>
            <input type="text" name="b21">
            <label for = "c21">C:</label>
            <input type="text" name="c21">
            <input type="submit">
        </form>
        <?php
            if (isset($_POST['a21']) and isset($_POST['b21']) and $_POST['c21']) {
                $array21 = [];
                array_push($array21, $_POST['a21'] * $_POST['a21']);
                array_push($array21, $_POST['b21'] * $_POST['b21']);
                array_push($array21, $_POST['c21'] * $_POST['c21']);
                sort($array21);
                echo ($array21[2] == $array21[1] + $array21[0]) ? 'true' : 'false';
            }
        ?>
    </p>

   <p>22.	В инпут вводится число. По нажатию на кнопку выведите список делителей этого числа.<br>
        <form method="post">
            <input type="text" name="text22" >
            <input type="submit">
        </form>
        <?php
            if (isset($_POST['text22'])) {
                echo implode(", ", dels($_POST['text22']));
            }
        ?>
    </p>

    <p>23.	В инпут вводится число. По нажатию на кнопку разложите число на простые множители.<br>
        <form method="post">
            <input type="text" name="text23" >
            <input type="submit">
        </form>
        <?php
            if (isset($_POST['text23'])) {
                function primeNumber($InputNumber) {
                    function isPrime($m) {
                        for ($i = 2; $i < $m; $i++) if ($m % $i == 0) return false;
                        return true;     
                    }

                    for ($i = 2; $i < $InputNumber; $i++) if ($InputNumber % $i == 0 && isPrime($i)) echo "$i ";
                };
                primeNumber($_POST['text23']);
            }
        ?>
    </p>

    <p>24.	В инпуты вводятся числа. По нажатию на кнопку выведите список общих делителей этих двух чисел.<br>
        25.	В инпуты вводятся числа. По нажатию на кнопку выведите наибольший общий делитель этих двух чисел.<br>
        <form method="post">
            <input type="text" name="a24" />
            <input type="text" name="b24" />
            <input type="submit">
        </form>
        <?php
            if (isset($_POST['a24']) and isset($_POST['b24'])) {
                $delA = dels($_POST['a24']);
                $delB = dels($_POST['b24']);
                echo implode(', ', array_intersect($delA, $delB));
                echo "<br>";
                echo max(array_intersect($delA, $delB));
               /*  echo "<br>";
                echo min(array_intersect($delA, $delB)); */
            }
        ?>
    </p>

    <p>26.	В инпуты вводятся числа. По нажатию на кнопку выведите наименьшее число, которое делится и на одно, и на второе из введенных чисел.<br>
        <form method="post">
            <input type="text" name="a26" />
            <input type="text" name="b26" />
            <input type="submit">
        </form>
        <?php
            function method26($a, $b){
                $max = $a > $b ? $a : $b;
                while (true) {
                    $max++;
                    if ($max % $a == 0 && $max % $b == 0) 
                        return $max;
                }
            }

            if (isset($_POST['a26']) and isset($_POST['b26']))
                echo method26($_POST['a26'], $_POST['b26']);
            
        ?>
    </p>

    <p>27.	В инпуты вводятся числа. По нажатию на кнопку выведите наименьшее число, которое делится и на одно, и на второе из введенных чисел.<br>
        <form method="post">
            <select name="day">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
            <select name="month">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
            <select name="year">
                <option value="1990">1990</option>
                <option value="1991">1991</option>
                <option value="1992">1992</option>
                <option value="1993">1993</option>
                <option value="1994">1994</option>
                <option value="1995">1995</option>
                <option value="1996">1996</option>
                <option value="1997">1997</option>
                <option value="1998">1998</option>
                <option value="1999">1999</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
            <input type="submit">
        </form>
        <?php
            if (isset($_REQUEST)) {
                $theDay = $daysoftheWeek[date('w', mktime(0, 0, 0, $_REQUEST['month'], $_REQUEST['day'], $_REQUEST['year']))];
                echo $_REQUEST['day']." ".$months[$_REQUEST['month']]." ".$_REQUEST['year']." - ".$theDay;
            }
        ?>
    </p>

</body>
</html>