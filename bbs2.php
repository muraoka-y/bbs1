<?php

//DBに接続
try {
    $pdo = new PDO('mysql:host=localhost;dbname=bbs', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    throw $e;
}
if(!empty($_POST)){

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
?>
<html>
<head>
掲示板
</head>
<body>
<form action="bbs2.php" method="POST" name="f1" >
<br>  
<br>
		1-Name
	<br>
		<input type="text"  name="name"  id="name" size="50"  placeholder="例；aaaa">
	<br>	
        投稿者のお名前を記入してください
    <br>
    2-Mail Address
    <br>
	<input type="text"  name="address"  id="address" size="50"  placeholder="例；xxx.klab.com">
    <br>
    3-title
    <br>
    <input type="text"  name="title"  id="title" size="50" >
    <br>
    4-TEXT
    <br>
	<textarea id="body" name="body" cols="100" rows="10" ></textarea>
    <br>
    <br>
    <p><input type="submit" value="Post" ></p>
    <p><input type="reset" value="Reset" ></p>
    <br>
    投稿
    <?php
$query = 'SELECT * FROM post ORDER BY posted_at DESC';
 foreach ($pdo->query($query) as $row) { //DBよりデータ取得
  
?>
<br>
[<?php echo $row['id'];?>] <?php echo $row['title'];?> <?php echo $row['name'];?>
<?php echo $row['posted_at'];?>
<br>
<?php echo $row['body'];?>
<?php
}
?>
    <br>

</form>
</body>
</html>