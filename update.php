<?php

require_once('funcs.php'); 

//1. POSTデータ取得
$name   = $_POST['name'];
$url  = $_POST['url'];
$comment    = $_POST['comment'];
$id = $_POST['id'];

//2. DB接続
$pdo = db_conn();

//3. データ登録SQL作成 SQL文の最後は;を入れる
$stmt = $pdo->prepare('UPDATE 
                        gs_bm_table 
                    SET
                       name = :name,
                       url = :url,
                       comment = :comment,
                       indate = sysdate()
                    WHERE
                        id = :id;
                    ');

// 数値（整数）の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//4. データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
    }