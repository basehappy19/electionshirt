<?php
require ('helper/server/db.php');
$sql_select = "SELECT class, SUM(vote_count) AS total_votes FROM votes WHERE class IN ('ม.2/3', 'ม.3/3') GROUP BY class";
$result = $conn->query($sql_select);

$sql = "SELECT class, shirt_id, COUNT(shirt_id) AS score FROM votes WHERE class IN ('ม.2/3', 'ม.3/3') GROUP BY class, shirt_id";
$result2 = $conn->query($sql);

$sql2 = "SELECT class, shirt_style, COUNT(shirt_style) AS scoreshirt FROM votes WHERE class IN ('ม.2/3', 'ม.3/3') GROUP BY class, shirt_style";
$result3 = $conn->query($sql2);

$shirt1 = 0;
$shirt2 = 0;

if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_assoc()) {
        if ($row3['shirt_style'] == "คอกลม") {
            $shirt1 += $row3['scoreshirt'];
        } elseif ($row3['shirt_style'] == "คอปก") {
            $shirt2 += $row3['scoreshirt'];
        }
    }
} else {
    echo "";
}


$voteCount2 = 0;
$voteCount3 = 0;
$score1 = 0;
$score2 = 0;
$score3 = 0;


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['class'] == 'ม.2/3') {
            $voteCount2 = $row['total_votes'];
        } elseif ($row['class'] == 'ม.3/3') {
            $voteCount3 = $row['total_votes'];
        }
    }
} else {
    echo "";
}

if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        if ($row2['shirt_id'] == '1') {
            $score1 += $row2['score'];
        } elseif ($row2['shirt_id'] == '2') {
            $score2 += $row2['score'];
        } elseif ($row2['shirt_id'] == '3') {
            $score3 += $row2['score'];
        }
    }
} else {
    echo "";
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="helper/style.css">
  <link rel="stylesheet" href="helper/bootstrap/css/bootstrap.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  
  <title>ผลการโหวต | MATHGIFT</title>
</head>
<body data-aos="fade" style="font-family: 'Prompt', sans-serif; background-color: #eeede2;">
  <div class="container mt-5 position-relative">
    <h1 class="mb-3">คะแนนโหวตเสื้อค่าย</h1>
    <div class="result text-center">
        <h5>จำนวนโหวต</h5>
        <h6>ม.2/3 :<span class="badge badge-info"><?php echo $voteCount2; ?>/36 คน</span></h6>
        <h6>ม.3/3 :<span class="badge badge-info"><?php echo $voteCount3; ?>/36 คน</span></h6>
    </div>
    <div class="scoreshirt text-center">
        <h5>แบบเสื้อ</h5>
        <h6>คอกลม :<span class="badge badge-org"><?php echo $shirt1; ?> คน</span></h6>
        <h6>คอปก :<span class="badge badge-org"><?php echo $shirt2; ?> คน</span></h6>
    </div>
    <div class="card-deck p-3 text-center">
        <div class="row my-5">
            <div class="card col-lg-6 mb-4">
                <h2 class="my-3">แบบที่ 1</h2>
                <img src="helper/shirt/1.jpg" class="card-img-top" alt="เสื้อคอกลม">
                <div class="card-body">
                    <h5 class="card-title">By โบนัส</h5>
                    <h2><span class="badge badge-success text-dark"><span class="text-success"><?php echo $score1; ?></span> คะแนน</span></h2> 
                </div>
            </div>
            <div class="card col-lg-6 mb-4">
                <h2 class="my-3">แบบที่ 2</h2>
                <img src="helper/shirt/2.jpg" class="card-img-top" alt="เสื้อคอปก">
                <div class="card-body">
                    <h5 class="card-title">By ม่อน</h5>
                    <h2><span class="badge badge-success text-dark"><span class="text-success"><?php echo $score2; ?></span> คะแนน</span></h2> 
                </div>
            </div>
            <div class="card col-lg-12 mb-4">
                <h2 class="my-3">แบบที่ 3</h2>
                <img src="helper/shirt/3.jpg" class="card-img-top" alt="เสื้อคอปก">
                <div class="card-body">
                    <h5 class="card-title">By ภูมิมี่</h5>
                    <h2><span class="badge badge-success text-dark"><span class="text-success"><?php echo $score3; ?></span> คะแนน</span></h2> 
                </div>
            </div>
        </div>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
  AOS.init();
</script>
</body>
</html>
