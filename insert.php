<?php
require_once('funcs.php');

/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

//1. POSTデータ取得
$name = $_POST['name'];
$url = $_POST['url'];
$comment = $_POST['comment'];

//2. DB接続します
try {
  //ID:'root', Password: 'root' gs_book_dbは接続したいファイル名を記載する
  $pdo = new PDO('mysql:dbname=gs_kadai;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }

// $pdo = db_conn();

//3. データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, name, url, comment, indate)VALUES(NULL, :name, :url, :comment, sysdate())");

//2. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

//3. 実行
$status = $stmt->execute();

//4. データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
}else{
//5. index.phpへリダイレクト 処理した後に元の画面に戻る
  header('Location: index.php');
}
?>
