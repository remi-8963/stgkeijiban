
 
<form method="POST" action="" enctype="multipart/form-data">
<input type="file" name="uploadfile" size="20">
<input type="submit" value="アップロード">
</form>

<?php
//$_FILES['time']が存在していれば
if(isset($_FILES['uploadfile'])){
    echo '$_FILES[\'uploadfile\']が送信されました。<br/>';
    echo print_r($_FILES['uploadfile']);
    echo '/';
    ?>
    
    <form action="" method="post">
    <input type="submit" value="クリア">
    </form>
   
<?php
$path = './imgs_sample/';
$file = $_FILES['uploadfile'];
    print('ファイル名:'.$file['name'].'<br/>');

move_uploaded_file($file['tmp_name'],$path.$file['name']);
// header('Content-type: image/png');
// readfile($_FILES['uploadfile']['tmp_name']);
}else{
    echo '$_FILES[\'uploadfile\']はまだ送信されていません。'."<br/>\n";
}
?>

</div>
<img src="<?=$file['name']?>"/>