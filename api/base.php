<?php
session_start();
date_default_timezone_set("Asia/Taipei");

class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db02";
    protected $table;
    protected $pdo;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, "root", "");
    }

    public function find($id)
    {
        $sql = "select * from $this->table ";
        if (is_array($id)) {
            $tmp = $this->arrayToSqlArray($id);
            $sql = $sql . " where " . join(" && ", $tmp);
        } else {
            $sql = $sql . " where `id`=$id";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function all(...$arg)
    {
        $sql = "select * from $this->table ";

        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->arrayToSqlArray($arg[0]);
                $sql = $sql . " where " . join(" && ", $tmp);
            } else {
                $sql = $sql . $arg[0];
            }
        }

        if (isset($arg[1])) {
            $sql = $sql . $arg[1];
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($array)
    {
        if (isset($array['id'])) {
            $id = $array['id'];
            unset($array['id']);
            $tmp = $this->arrayToSqlArray($array);
            $sql = "update $this->table set " . join(",", $tmp) . " where `id`='$id'";
        } else {
            $cols = array_keys($array);
            $sql = "insert into $this->table (`" . join("`,`", $cols) . "`) values ('" . join("','", $array) . "')";
        }

        $this->pdo->exec($sql);
    }

    public function del($id)
    {
        $sql = "delete from $this->table ";
        if (is_array($id)) {
            $tmp = $this->arrayToSqlArray($id);
            $sql = $sql . " where " . join(" && ", $tmp);
        } else {
            $sql = $sql . " where `id`='$id'";
        }
        $this->pdo->exec($sql);
    }

    public function count(...$arg)
    {
        return $this->math('count', ...$arg);
    }

    public function sum($col, ...$arg)
    {
        return $this->math('sum', $col, ...$arg);
    }

    public function max($col, ...$arg)
    {
        return $this->math('max', $col, ...$arg);
    }

    public function min($col, ...$arg)
    {
        return $this->math('min', $col, ...$arg);
    }

    public function avg($col, ...$arg)
    {
        return $this->math('avg', $col, ...$arg);
    }

    private function arrayToSqlArray($array)
    {
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }

    private function math($math, ...$arg)
    {
        switch ($math) {
            case 'count':
                $sql = "select count(*) from $this->table ";
                if (isset($arg[0])) {
                    $con = $arg[0];
                }
                break;
            default:
                $col = $arg[0];
                if (isset($arg[1])) {
                    $con = $arg[1];
                }
                $sql = "select $math($col) from $this->table ";
        }
            
        if (isset($con)) {
            if (is_array($con)) {
                $tmp = $this->arrayToSqlArray($con);
                $sql = $sql . " where " . join(" && ", $tmp);
            } else {
                $sql = $sql . $con;
            }
        }
        //?????? FETCHCOLUMN() ??????????????????????????????????????????(???0??????????????????)
        return $this->pdo->query($sql)->fetchColumn();
    }
}

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url){
    header("location:".$url);
}

function q($sql){
    $pdo=new PDO("mysql:host=localhost;charset=utf8;dbname=db02",'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

$Total=new DB('total');
$User=new DB('user');
$News=new DB('news');
$Que=new DB('que');
$Log=new DB('log');

//??????????????????,??????session['total']??????,??????????????????????????????,????????????total???total??????+1.
//????????????,???????????????date????????????????????????,total????????????1.
//???????????????????????????, session['total']????????????1.
if(!isset($_SESSION['total'])){
    $today=$Total->find(['date'=>date("Y-m-d")]);
    if(empty($today)){
        $today=['date'=>date("Y-m-d"),'total'=>1];

    }else{
        $today['total']++;
    }
    $Total->save($today);
    $_SESSION['total']=1;
}


