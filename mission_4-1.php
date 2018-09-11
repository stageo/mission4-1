<?php
 $dsn = 'データベース名';
 $user = 'ユーザー名';
 $password = 'パスワード';
 $pdo = new PDO($dsn,$user,$password);
 $sql = "CREATE TABLE test009"
 ."("
 ."id INT AUTO_INCREMENT primary key,"
 ."name char(32),"
 ."comment TEXT,"
 ."time TEXT,"
 ."password TEXT"
 .");";
 $stmt = $pdo -> query($sql);
  
   $date =date("Y/n/j H:i:s");
   $t = "<>";

 if (!empty($_POST['edit']) && !empty($_POST['edit-pass']) && empty($_POST['name']) && empty($_POST['message']) && empty($_POST['delete']) && empty($_POST['hidden']) && empty($_POST['send-pass']) && empty($_POST['delete-pass']) ) {
   
   $pass = $_POST['edit-pass'];
   $id = $_POST['edit'];
   $sql = "SELECT * FROM test009 where id=$id AND password = $pass";
   $result = $pdo -> query($sql);
   $row = $result ->fetch(PDO::FETCH_BOTH);
   
          $l1 = $id;
          $l2 = $row[1];
          $l3 = $row[2];
     
             
          }
?>
<!DOCTYPE html>
<html lang = “ja”>
<body>
<form action="mission_4-1.php" method="post" >
  <input type="text" name="name"  placeholder="名前" value="<?php echo $l2 ?>" ><br>
  <input type="text" name="message"  placeholder="コメント" value="<?php echo $l3 ?>" ><br>
  <input type="text" name="send-pass" placeholder="パスワード" >
  <input type="hidden" name="hidden" value="<?php echo $l1 ?>" ><br>
  <input type="submit" value="送信"><br><br>
  <input type="text" name="delete" placeholder="削除対象番号" ><br>
  <input type="text" name="delete-pass" placeholder="パスワード" >
  <input type="submit" value="削除"><br><br>
  <input type="text" name="edit" placeholder="編集対象番号" ><br>
  <input type="text" name="edit-pass" placeholder="パスワード" >
  <input type="submit" value="編集">
</form>
</body>
</html>
<?php
 
   
 if (!empty($_POST['name']) && !empty($_POST['message']) && !empty($_POST['send-pass']) && empty($_POST['hidden']) && empty($_POST['delete']) && empty($_POST['edit']) && empty($_POST['delete-pass']) && empty($_POST['edit-pass']) ) {
 $sql = $pdo -> prepare("INSERT INTO test009 ( name, comment, time, password) VALUES (  :name, :comment, :time, :password)");
 
 $sql -> bindParam(':name', $name, PDO::PARAM_STR);
 $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
 $sql -> bindParam(':time', $time, PDO::PARAM_STR);
 $sql -> bindParam(':password', $password, PDO::PARAM_STR);
  
   $name = $_POST['name'];
   $comment = $_POST['message'];
   $time = $date;
   $password = $_POST['send-pass'];
   $sql -> execute();
   
   
 }

 if (!empty($_POST['delete']) && !empty($_POST['delete-pass']) && empty($_POST['name']) && empty($_POST['message']) && empty($_POST['hidden']) && empty($_POST['edit']) && empty($_POST['send-pass']) && empty($_POST['edit-pass']) ) {
 
 $pass = $_POST['delete-pass'];
 $id = $_POST['delete']; 
 $sql = "delete from test009 where id=$id AND password = $pass";  
 $result = $pdo->query($sql);
 
 }
 
 if (!empty($_POST['hidden']) && !empty($_POST['name'])  && !empty($_POST['message']) && empty($_POST['edit']) && empty($_POST['delete']) && empty($_POST['send-pass']) && empty($_POST['delete-pass']) && empty($_POST['edit-pass']) ) {
    
    $id = $_POST['hidden'];
    $nm = $_POST['name'];
    $kome = $_POST['message'];
    $date =date("Y/n/j H:i:s");
    $newtime = $date;
    $sql = "update test009 set name='$nm', comment='$kome', time='$newtime' where id = $id";
    $result = $pdo->query($sql);
     
     }
  
 
 $sql = 'SELECT * FROM test009';
 $results = $pdo -> query($sql);
 foreach ($results as $row){
                             echo $row['id'].$t;
                             echo $row['name'].$t;
                             echo $row['comment'].$t;
                             echo $row['time'].$t;
                             echo $row['password'].'<br>';
                            }
?>

