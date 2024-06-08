<?php

define('Token', 'HGsZOXpfNC');
$skills = [];
$skill_levels = [];
$hobbies = [];
$institutes = [];
$degrees = [];
$froms = [];
$tos = [];
$grades = [];
$titles = [];
$descriptions = [];
if (Token == $_POST['token']) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $location = $_POST['location'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $summary = $_POST['summary'];
   
    $profile = isset($_POST['profile']) ? $_POST['profile'] : 'default-profile.png';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <link rel="stylesheet" href="style.css">

  <title><?php echo ucwords($first_name) . ' Resume'; ?></title>
</head>
<body>

<div id="whatToPrint" class="grid-container">
  <div class="zone-1">
    <div class="toCenter">
      <h1 class="highlight"><?php echo ucwords($first_name);?></h1>
    </div>
    <div class="contact-box">
      <div class="title">
        <h2>Contact</h2>
      </div>
      <div class="call"><i class="fas fa-phone-alt"></i>
        <div class="text"><?php echo $phone;?></div>
      </div>
      <div class="Age"><i class="fas fa-envelope"></i>
<!--        <div class="text">--><?php //echo $Age;?><!--</div>-->
      </div>
      <div class="email"><i class="fas fa-envelope"></i>
        <div class="text"><?php echo $email;?></div>
      </div>
    </div>
    <div class="personal-box">
      <div class="title">
        <h2>Skills</h2>
      </div>
      <?php
      for ($j=0; $j<count($skills); $j++) {
          echo "<div class='skill-1'>
                  <p><strong>" . strtoupper($skills[$j]) . "</strong></p>
                  <div class='progress'>";
            for ($i=0; $i<$skill_levels[$j]; $i++) {
              echo '<div class="fas fa-star active"></div>';
            }
            echo '</div></div>';
          }
      ?>
    </div>
    <div class="hobbies-box">
      <div class="title">
        <div class="box">
        <h2>Hobbies</h2>
        </div>
      </div>
      <?php
        foreach ($hobbies as $hobby) {
          echo "<div class='d-flex align-items-center'>
          <div class='circle'></div>
          <div><strong>" . ucwords($hobby) . "</strong></div>
        </div>";
        }
      ?>
    </div>
  </div>

  <!-- ZONE 2 -->


  <div class="zone-2">
    <div class="headTitle">
      <h1><?php echo ucwords($last_name);?></b></h1>
    </div>
    <div class="subTitle">
      <h1><?php echo ucwords($location);?><h1>
    </div>
    <div class="group-1">
      <div class="title">

        <div class="box">
          <h2>About Me</h2>
        </div>
        <p><?php echo ucwords($summary);?></p>
      </div>
<!--      <div class="desc">--><?php //echo $about_me;?><!--</div>-->
    </div>
    <div class="group-2">
      <div class="title">
        <div class="box">
          <h2>Education</h2>
        </div>
      </div>
      <div class="desc">
        <?php
          for ($i=0; $i<count($institutes);$i++) {
            echo "<ul>
            <li>
              <div class='msg-1'>" . $froms[$i] . "-" . $tos[$i]. " | " . ucwords($degrees[$i]) . ", " . $grades[$i]. "</div>
              <div class='msg-2'>" . ucwords($institutes[$i]) . "</div>
            </li>
          </ul>";
          }
        ?>
      </div>
    </div>
    <div class="group-3">
      <div class="title">
        <div class="box">
          <h2>Experience</h2>
        </div>
      </div>
      <div class="desc">
      <?php
          for ($i=0; $i<count($titles);$i++) {
            echo "<ul>
            <li>
              <div class='msg-1'><br></div>
              <div class='msg-2'>" . ucwords($titles[$i]) ."</div>
              <div class='msg-3'>" . ucfirst($descriptions[$i]) . "</div>
            </li>
          </ul>";
          }
        ?>
      </div>
    </div>
  </div>
  <a href="javascript:generatePDF()" id="downloadButton">Click to download</a>
</div>

<script>
async function generatePDF() {
    document.getElementById("downloadButton").innerHTML = "Currently downloading, please wait";

    const A4_WIDTH = 595.28;
    const A4_HEIGHT = 841.89;

    var downloading = document.getElementById("whatToPrint");


    const { jsPDF } = window.jspdf;
    var doc = new jsPDF('p', 'pt', 'a4');

    try {
        const canvas = await html2canvas(downloading, {
            scale: 2,
            useCORS: true,
            allowTaint: true,
            logging: true,
            display: 'block',
        });

        var imgData = canvas.toDataURL('image/png');
        var imgWidth = A4_WIDTH;
        var pageHeight = A4_HEIGHT;
        var imgHeight = (canvas.height * imgWidth) / canvas.width;
        var heightLeft = imgHeight;

        var position = 0;

        doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
        heightLeft -= pageHeight;

        while (heightLeft >= 0) {
            position = heightLeft - imgHeight;
            doc.addPage();
            doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
        }

        doc.save("Document.pdf");
        document.getElementById("downloadButton").innerHTML = "Click to download";
    } catch (error) {
        console.error("Error generating PDF: ", error);
        document.getElementById("downloadButton").innerHTML = "Click to download";
    }
}
</script>

</body>
</html>
