<?php
// updateからベースをコピー
require_once('funcs.php'); 

//1. POSTデータ取得
$id = $_GET['id'];

//2. DBに接続
$pdo = db_conn();

//3. データ登録SQL作成 SQL文の最後は;を入れる
//　:idなしでテーブルごと削除
$stmt = $pdo->prepare('DELETE FROM gs_bm_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//4. データ登録処理後
if ($status === false) {
    sql_error($stmt);
} else {
    redirect('select.php');
};

?>