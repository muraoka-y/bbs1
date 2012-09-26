<?php

//DBに接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbs', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    throw $e;
}
if(!empty($_POST[Post])){
//新規データがからでなければデータ追加
$query ='insert into post (name,address,title,body,posted_at)values (?, ?, ?, ?, ?)';

$stmt =$pdo->prepare($query);

try {
    $result =$stmt->execute(array(
        $_POST['name'],
        $_POST['address'],
        $_POST['title'],
        $_POST['body'],
        date('Y-m-d H:i:s', time()),
        ));
} catch (Exception $e) {
    throw $e;
}
var_dump($result);
}
//データ削除
$del_no = $_POST['del_no'];
if($_POST['delete'] ){//削除ナンバーの入力を確認したら
  $sql ="delete from post where id = ".$del_no."";
  //データベースの項目が$del_noと一致すると削除
  echo "$sql";
  $delete = mysql_query("delete from post where id = '49'");
  var_dump($delete);
  
 // $select=mysql_query('SELECT name FROM post where id=49');
  //$row =mysql_fetch_assoc($select);
  //echo $row['name'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
"http://www.w3.org/TR/html4/frameset.dtd">
<HTML lang="ja-JP">
<head>
  <link rel="stylesheet" href="bbs.css">
  <META http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <META HTTP-EQUIV="CONTENT-STYLE-TYPE" CONTENT="text/css">
  <title>BBS</title>
</head>
<body>
  <h1>BBS</h1>
  <img src="bahamut.jpeg" width="100" height="100" alt="bahamut" style="float:right;">
<form action="bbs2.php" method="POST" name="f1" enctype="multipart/form-data">

<div id="header"> Write your information </div>
  <div class="form">
    <label for="name">1-Name:</label> 
    <p><input type="text"  name="name"  id="name" size="50"  placeholder="例；aaaa"></p></div>
    <p><style="color:red; solid #f00">投稿者のお名前を記入してください</p>
    

  <div class="form">
    <label for="address">2-Adress:</label> 
    <p><input type="text"  name="address"  id="address" size="50"  placeholder="例；xxx.klab.com"></p>
  </div>
  
  <div class="form">
    <label for="title">3-title:</label> 
    <p><input type="text"  name="title"  id="title" size="50" ></p>
  </div>
   
  <div class="form">
    <label for="body">4-text:</label> 
    <p><textarea id="body" name="body" cols="100" rows="10" ></textarea></p>
  </div>

  <div class="form">
    <p><input type="file" name="picture" ></p>
    <p><input type="submit" value="Post" class=button ></p>
    <p><input type="reset" value="Reset" class=button ></p>
   </div> 
    
    <div id="main"> Contribution</div>
   削除No:<input type="text" name="del_no" size="5" > 削除したい投稿の番号を入力してください
  <p><input type="submit" name="delete" value="delete" class=button ></p>
    
<?php
//DBよりデータ取得
$query = 'SELECT * FROM post ORDER BY posted_at DESC';
 foreach ($pdo->query($query) as $row):
?>

<br>
[<?=$row['id']?>] <?=$row['title']?> <?=$row['name']?>
<?=$row['posted_at']?>
<br>
<?=$row['body']?>
<?php endforeach; ?>
<br>

</form>
</body>
</html>