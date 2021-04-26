<?PHP 
include("linkedlist.class.php");


$testando = new LinkedList();

if($testando.insertFirst("oi")){
    echo 'true - 1';
}else{
    echo 'falso - 1';
}
?>