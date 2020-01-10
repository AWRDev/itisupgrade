<html>
    <form action="" method="POST">
        <input type="text" name='url'>
    </form>
</html>
<?php
function getURLType($url){
    if(strpos($url, '?')!==false){
        $slash_pos = strpos($url, '/', 10)+1;
        $qmark_pos = strpos($url, '?');
        $res_str = substr($url, $slash_pos, $qmark_pos - $slash_pos);
        return $res_str;
    }
    else{
        return 'Scrolling';
    }
}
function testSubstr(){
    $str = $_POST['url'];
    echo substr($str,0,7).'<br>';
    echo substr($str,strlen($str)-4, 4);
}
testSubstr();
$ex_url = explode('/', $_POST['url']);
        //var_dump($ex_url);
//echo getURLType($_POST['url']);
?>

select id, sum(par) as par from t group by id 
having sum(par) >= ALL(
select sum(par) from t group by id
);