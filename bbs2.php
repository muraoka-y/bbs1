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
<!DOCTYPE html>
<html>
<head>
  <title>
    BBS
  </title>
<link rel="stylesheet" href="bbs.css">
</head>
<body>
  <h1>BBS</h1>
  <img src="bahamut.jpeg" width="100" height="100" alt="bahamut" style="float:right;">
<form action="bbs2.php" method="POST" name="f1" enctype="multipart/form-data">

<div id="header"> Write your information </div>
  <div class="form">
    <label for="name">1-Name:</label> 
    <input type="text"  name="name"  id="name" size="50"  placeholder="例；aaaa"></p></div>
    <span class="point"><p style="color:red; solid #f00">投稿者のお名前を記入してください</p></span>
    

  <div class="form">
    <label for="address">2-Adress:</label> 
    <input type="text"  name="address"  id="address" size="50"  placeholder="例；xxx.klab.com"></p>
  </div>
  
  <div class="form">
    <label for="title">3-title:</label> 
    <input type="text"  name="title"  id="title" size="50" ></p>
  </div>
   
  <div class="form">
    <label for="body">4-text:</label> 
    <textarea id="body" name="body" cols="100" rows="10" ></textarea></p>
  </div>

  <div class="form">
    <p><input type="file" name="picture" ></p>
    <p><input type="submit" value="Post" class=button ></p>
    <p><input type="reset" value="Reset" class=button ></p>
   </div> 
    
    <div id="main"> Contribution</div>
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