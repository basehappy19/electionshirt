<?php

session_start();
require('helper/server/db.php');


if(isset($_SESSION['voted']) && $_SESSION['voted'] == true) {
    header("Location: voted.php"); 
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $class = $_POST['class'];
    $shirtStyle = $_POST['shirtStyle'];
    $shirtID = $_POST['shirtID'];

    
    $sql_insert = "INSERT INTO votes (class, shirt_style, shirt_id) VALUES ('$class', '$shirtStyle', '$shirtID')";
    
    if ($conn->query($sql_insert) === TRUE) {
        
        $sql_update = "UPDATE votes SET vote_count = 1 WHERE class = '$class' AND shirt_style = '$shirtStyle'";
        $conn->query($sql_update);
        $_SESSION['voted'] = true;
        
        header("Location: voted.php");
        exit();
    } else {
        // 
        echo "";
    }

    $conn->close();
} else {
    echo "";
}
$sql_select = "SELECT class, SUM(vote_count) AS total_votes FROM votes WHERE class IN ('ม.2/3', 'ม.3/3') GROUP BY class";
$result = $conn->query($sql_select);

$voteCount2 = 0;
$voteCount3 = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['class'] == 'ม.2/3') {
            $voteCount2 = $row['total_votes'];
        } elseif ($row['class'] == 'ม.3/3') {
            $voteCount3 = $row['total_votes'];
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="helper/style.css">
  <link rel="stylesheet" href="helper/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <title>โหวตเสื้อค่าย | MATHGIFT</title>
</head>
<body style="font-family: 'Prompt', sans-serif; background-color: #eeede2;">

  <div class="container mt-5 position-relative">
    <h1 class="mb-4" data-aos="fade">โหวตเสื้อค่าย</h1>
    <div class="result text-center" data-aos="fade">
        <h5>จำนวนโหวต</h5>
        <h6>ม.2/3 :<span class="badge badge-info"><?php echo $voteCount2; ?>/36 คน</span></h6>
        <h6>ม.3/3 :<span class="badge badge-info"><?php echo $voteCount3; ?>/36 คน</span></h6>
    </div>
    <form id="votingForm" method="post" action="">
      <div class="form-group my-3" data-aos="fade">
        <label for="class" class="mt-3">ชั้นเรียน</label>
        <select style="color: #888;" class="form-select" id="class" name="class" required>
            <option value="" <?php if(!isset($_POST['class']) || (isset($_POST['class']) && $_POST['class'] == '')) echo 'selected'; ?> style="display: none;" disabled>เลือกชั้นเรียน</option>
            <option value="ม.2/3" <?php if(isset($_POST['class']) && $_POST['class'] == 'ม.2/3') echo 'selected'; ?>>ม.2/3</option>
            <option value="ม.3/3" <?php if(isset($_POST['class']) && $_POST['class'] == 'ม.3/3') echo 'selected'; ?>>ม.3/3</option>
        </select>
      </div>

      <div class="form-group my-3" data-aos="fade">
        <label for="shirtStyle">ลักษณะคอเสื้อ</label>
        <select style="color: #888;" class="form-select" id="shirtStyle" name="shirtStyle" required>
            <option value="" <?php if(!isset($_POST['shirtStyle']) || (isset($_POST['shirtStyle']) && $_POST['shirtStyle'] == '')) echo 'selected'; ?> style="display: none;" disabled>เลือกลักษณะคอเสื้อ</option>
            <option value="คอกลม" <?php if(isset($_POST['shirtStyle']) && $_POST['shirtStyle'] == 'คอกลม') echo 'selected'; ?>>คอกลม</option>
            <option value="คอปก" <?php if(isset($_POST['shirtStyle']) && $_POST['shirtStyle'] == 'คอปก') echo 'selected'; ?>>คอปก</option>
        </select>
      </div>
      <div class="card-deck my-3 p-3 text-center">
        <div class="row" data-aos="fade">
            <div class="card col-lg-6 mb-4">
                <h2 class="my-3">แบบที่ 1</h2>
                <img src="helper/shirt/1.jpg" class="card-img-top">
                <div class="card-body">
                    
                    <h5 class="card-title">By โบนัส</h5>
                    <a href="helper/shirt/1.jpg" type="button" class="btn animated-button btn-primary fw-bold" style="background: #827B54;"><i class="bi bi-arrows-fullscreen"></i></a>
                    <button type="submit" class="btn animated-button btn-primary fw-bold" name="shirtID" value="1" style="background: #827B54;">VOTE</button>
                </div>
            </div>
            <div class="card col-lg-6 mb-4">
                <h2 class="my-3">แบบที่ 2</h2>
                <img src="helper/shirt/2.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">By ม่อน</h5>
                    <a href="helper/shirt/2.jpg" type="button" class="btn animated-button btn-primary fw-bold" style="background: #827B54;"><i class="bi bi-arrows-fullscreen"></i></a>
                    <button type="submit" class="btn animated-button btn-primary fw-bold" name="shirtID" value="2" style="background: #827B54;">VOTE</button>
                </div>
            </div>
            <div class="card col-lg-12 mb-4">
                <h2 class="my-3">แบบที่ 3</h2>
                <img src="helper/shirt/3.jpg" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">By ภูมิมี่</h5>
                    <a href="helper/shirt/3.jpg" type="button" class="btn animated-button btn-primary fw-bold" style="background: #827B54;"><i class="bi bi-arrows-fullscreen"></i></a>
                    <button type="submit" class="btn animated-button btn-primary fw-bold" name="shirtID" value="3" style="background: #827B54;">VOTE</button>
                </div>
            </div>
        </div>
    </div>
    </form>
  </div>
  <script>
    document.getElementById("votingForm").addEventListener("submit", function(event) {
        var confirmed = confirm("แน่ใจจะโหวตมั้ย ไม่สามารถเปลี่ยนการโหวตได้นะ?");
        if (!confirmed) {
            event.preventDefault();
        }
    });
    </script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</html>
