<html>
<head>
    <title>Задание: Ферма ООП</title>
</head>
<body>

<?php

//  добавление новых типов животных в которую не требовало бы модификации класса самой фермы.
//  увидеть реализацию механизма наследования.

abstract class AnimalsParam { // создаём абстрактный класс
    public function __construct($type, $id, $product_name, $units, $harvest_min, $harvest_max){  // определяем конструктор с необходимыми входящими данными животных
        $this->type = $type; // название типа животного
        $this->id = "животноеID".$id; // присваеваем id животному
        $this->product_name = $product_name; // наименование продукции производимого животным
        $this->units = $units; // единица измерения продукции
        $this->harvest_min = $harvest_min; // минимально возможное количество продукции с 1 животного
        $this->harvest_max = $harvest_max; // максимально возможнон количество продукции с 1 животного
    }

    public function harvesting(){ // собираем продукцию с объекта животного
        return $this->products = rand ($this->harvest_min, $this->harvest_max); // определяем колличество полученной продукции из возможног диапозона
    }
}

class NewAnimals extends AnimalsParam{ // Создаём дочерний класс для создания объектов животных

}

class NewCrib { // Описываем класс ХЛЕВ

    # делаем свойства доступными методам собственного класса
    protected $regAnimals; // используем для хранения всех зарегистрированных животных в хлеву
    protected $regProducts; // используем для хранения суммарных значений продукции по каждому типу животных

    public function __construct(){ // определяем конструктор, который будет выплнен при создании объекта ХЛЕВ
        echo "Новый ХЛЕВ создан, можно заселять животных! <br><br>"; // сообщаем, что хлев создан и можно заселять животных
    }

    function AddAnimals($type, $counts, $product_name, $units, $harvest_min, $harvest_max){ // метод добавления животных в хлев
        for ($i=1; $i < $counts+1; $i++) {
            $this->regAnimals[$type][$i] = new NewAnimals($type, $i, $product_name, $units, $harvest_min, $harvest_max); // создаём массив с зарегистрированными животными
        }
    }

    function ProductCollection(){ // функция сбора продукции со всех зарегистрированных в хлеву животных
        echo "Зарегистрированы животные:<br> ";
        foreach ($this->regAnimals as $key => $value) { // перебор всех типов зарегистрированных в хлеву животных
            echo "<br>".$key." — ".count($value)." шт. <br>";  // выводим тип и колличетсво животных
            foreach ($value as $animal){ // перебор животных внутри типа
                echo $animal->id." принесло ".$animal->product_name." — ".$animal->harvesting()." ".$animal->units."<br>";
                $this->regProducts[$key]['total']=$this->regProducts[$key]['total'] + $animal->products; // суммируем всю продукцию по типу живтных
                $this->regProducts[$key]['product_name'] = $animal->product_name; // название продукции для понятности
                $this->regProducts[$key]['units'] = $animal->units; // единица изменения продукции для понятности
            }
        }
        foreach ($this->regProducts as $key => $value){ // вывод суммарных значений продукции
            echo "<b>Итого ".$value['product_name']." ".$key.": ".$value['total']." ".$value['units']."</b> <br>";  // выводим тип и колличетсво животных
        }
    }
}

$NewCrib = new NewCrib(); // создаём новый ХЛЕВ
$NewCrib->AddAnimals("страусов", 6, "яиц", "шт.", 1, 3); // Создаём коров и добавляем их в хлев
$NewCrib->AddAnimals("куриц", 20, "яиц", "шт.", 0, 1); // Создаём коров и добавляем их в хлев
$NewCrib->AddAnimals("коров", 10, "молока", "л.", 8, 12); // Создаём коров и добавляем их в хлев
$NewCrib->ProductCollection(); // Собираем всю продукцию с животных в хлеву
 ?>

</body>
</html>
