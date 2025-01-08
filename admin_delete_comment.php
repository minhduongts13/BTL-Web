<?php
include 'connect.php';

if (isset($_GET['idUser'])&&isset($_GET['idSong'])) {
    $idUser = $_GET['idUser'];
    $idSong = $_GET['idSong'];
    $stmt = $db->prepare("DELETE FROM NOI_DUNG_BINH_LUAN WHERE ID_nguoi_dung = $idUser AND ID_Bai_hat = $idSong");
    try {
        $stmt->execute();
        header("Location: admin_user_infor.php?id=$idUser");
    } catch (PDOException $e) {
        $error = "Lỗi: " . $e->getMessage();
    }
}
?>

