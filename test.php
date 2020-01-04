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
$ex_url = explode('/', $_POST['url']);
        var_dump($ex_url);
//echo getURLType($_POST['url']);
?>