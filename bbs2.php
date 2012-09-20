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
style type="text/css">

.button {
   border-top: 1px solid #3225e6;
   background: #e6e617;
   background: -webkit-gradient(linear, left top, left bottom, from(#e01d1d), to(#e6e617));
   background: -webkit-linear-gradient(top, #e01d1d, #e6e617);
   background: -moz-linear-gradient(top, #e01d1d, #e6e617);
   background: -ms-linear-gradient(top, #e01d1d, #e6e617);
   background: -o-linear-gradient(top, #e01d1d, #e6e617);
   padding: 12.5px 25px;
   -webkit-border-radius: 12px;
   -moz-border-radius: 12px;
   border-radius: 12px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 20px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
   }
.button:hover 
{
     border-top: 1px solid #3225e6;
   background: #2dc5e0;
   background: -webkit-gradient(linear, left top, left bottom, from(#231dde), to(#2dc5e0));
   background: -webkit-linear-gradient(top, #231dde, #2dc5e0);
   background: -moz-linear-gradient(top, #231dde, #2dc5e0);
   background: -ms-linear-gradient(top, #231dde, #2dc5e0);
   background: -o-linear-gradient(top, #231dde, #2dc5e0);
   padding: 12.5px 25px;
   -webkit-border-radius: 12px;
   -moz-border-radius: 12px;
   border-radius: 12px;
   
   }
.button:active 
{
     border-top: 1px solid #3225e6;
   background: #dede2f;
   background: -webkit-gradient(linear, left top, left bottom, from(#1fde26), to(#dede2f));
   background: -webkit-linear-gradient(top, #1fde26, #dede2f);
   background: -moz-linear-gradient(top, #1fde26, #dede2f);
   background: -ms-linear-gradient(top, #1fde26, #dede2f);
   background: -o-linear-gradient(top, #1fde26, #dede2f);
   padding: 12.5px 25px;
   -webkit-border-radius: 12px;
   -moz-border-radius: 12px;
   border-radius: 12px;
   
   }
</style>
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
    <p><input type="submit" value="Post" class=button></p>
    <p><input type="reset" value="Reset" class=button></p>
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