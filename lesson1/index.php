<?php

// task1

echo "<h3>Задание №1</h3>";

class Transport {

    protected $color;
    protected $speed;
    protected $weight;

    public function __construct($color, $speed, $weight)
    {
        $this->color = $color;
        $this->speed = $speed;
        $this->weight = $weight;
    }

    public function getTransportName()
    {
        echo static::class . '<br>';
    }
}

class Car extends Transport {

    public function ride()
    {
        echo "Ездить";
    }
}

class Plane extends Transport {

    public function fly()
    {
        echo "Летает";
    }
}

class Ship extends Transport {

    public function swim()
    {
        echo "Плавает";
    }
}

$car = new Car('grey', 180, 2000);
$car->getTransportName();

$plane = new Plane('black', 850, 42500);
$plane->getTransportName();

$ship = new Ship('white', 400, 140000);
$ship->getTransportName();


// task2

echo "<h3>Задание №2</h3>";

class Db {

    protected $tableName;
    protected $wheres = [];

    public static $queryString = null;

    public function table($tableName) {
        $this->setTableName($tableName);
        return $this;
    }

    public function getQueryString() {
        if (is_null(static::$queryString)) {
            static::$queryString = "SELECT * FROM" . " " . $this->getTableName();
        }
        return static::$queryString;
    }

    public function getAll() {
       return $this->getQueryBuilder();
    }

    public function getOne($id) {
        $this->where('id', $id);
        return $this->getQueryBuilder();
    }

    public function get() {
        return $this->getQueryBuilder();
    }

    public function getQueryBuilder() {
        $sql = $this->getQueryString();
        $this->populate($sql);
        return $sql . PHP_EOL;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    public function where($field, $value) {
        $this->wheres[] = [
            'field' => $field,
            'value' => $value
        ];
        return $this;
    }

    public function andWhere($field, $value) {
        return $this->where($field, $value);
    }

    protected function populate(&$queryString) {
        if (!empty($this->wheres)) {
            $queryString .= " WHERE ";
            foreach ($this->wheres as $value) {
                $queryString .= $value['field'] . " = " . $value['value'];
                if ($value != end($this->wheres)) $queryString .= " AND ";
            }
            $this->wheres = [];
        }
    }
}

$db = new Db();
echo $db->table('product')->where('name', 'Alex')->where('session', 123)->andWhere('id', 5)->get();


// task3

echo "<h3>Задание №3</h3>";

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
// Создание экземпляра класса А
$a1 = new A();
$a2 = new A();

// Вывоз метода foo
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();

// Результат: 1234 - потому что, локальная переменная x относится к классу А, а не к объектам а1 и а2


// task4

echo "<h3>Задание №4</h3>";

class B extends A {
}

// Создание экземпляра классов
$a1 = new A();
$b1 = new B();

// Вывоз метода foo
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

// Результат: 5162 - потому что, локальная переменная относится к классу, поэтому в классе А начинается с 4, а в классе B c 0


// task5

echo "<h3>Задание №5</h3>";

// Создание экземпляра классов
$a1 = new A;
$b1 = new B;

// Вывоз метода foo
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

// Результат: 7384 - аналогичный случай с 4 задачей