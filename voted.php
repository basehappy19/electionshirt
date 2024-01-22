<?php 
session_start(); 


if(!isset($_SESSION['voted']) || $_SESSION['voted'] != true) {
    header("Location: index.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โหวตเรียบร้อย | MATHGIFT</title>
    <link rel="stylesheet" href="helper/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="helper/stylevote.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>
<body data-aos="zoom-in">
    <div class="container text-center m-5">
        <h3>โหวตเสร็จแล้ว</h3>
        <h6>สามารถดูคะแนน ดูจำนวนโหวตได้ที่นี้เลย 👇🏻</h6>
        <a href="score.php" class="btn btn-primary my-3 animated-button" style="background: #827B54;" target="_blank">ดูผลโหวต</a>
    </div>
</body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  AOS.init();
</script>
</html>

