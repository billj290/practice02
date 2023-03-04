<?php

include_once "base.php";

$news=$_POST['news'];
$user=$_POST['user'];
echo $news;
echo $user;

$chk=$Log->count(['news'=>$news,'user'=>$user]);
$row=$News->find($news);
// dd($chk);
// dd($row);
if($chk>0){
    $Log->del(['news'=>$news,'user'=>$user]);
    $row['good']--;
    $News->save($row);

}else{
    $Log->save(['user'=>$user,'news'=>$news]);
    $row['good']++;
    $News->save($row);
}

?>
