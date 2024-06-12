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
    $race = $_POST['race'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $summary = $_POST['summary'];
   
    $profile = isset($_POST['profile']) ? $_POST['profile'] : 'default-profile.png';
}

?>
<?php
// PHP variables for the CV content
$name = "Name & Surname";
$contact_details = " Town, Province | Cell number | Age / Sex / Race | email address";
$summary = "Summary of the individual – This is a space to express your passion, development, and ambition within your career. A creative story telling segment that showcases not just your interests, but capabilities as unique individual wanting to make an impact for the future!";

$experiences = [
    ["year" => 2024, "title" => "Most Recent Employment or Education", "description" => "A description of the role or academic journey taken. Including a description of the key areas of expertise, skills excellence and what you did really well within this period."],
    ["year" => 2022, "title" => "Most Recent Employment or Education", "description" => "A description of the role or academic journey taken. Including a description of the key areas of expertise, skills excellence and what you did really well within this period."],
    ["year" => 2019, "title" => "Most Recent Employment or Education", "description" => "A description of the role or academic journey taken. Including a description of the key areas of expertise, skills excellence and what you did really well within this period."],
    ["year" => 2019, "title" => "Most Recent Employment or Education", "description" => "A description of the role or academic journey taken. Including a description of the key areas of expertise, skills excellence and what you did really well within this period."],
    ["year" => 2017, "title" => "Most Recent Employment or Education", "description" => "A description of the role or academic journey taken. Including a description of the key areas of expertise, skills excellence and what you did really well within this period."],
    ["year" => 2016, "title" => "Most Recent Employment or Education", "description" => "A description of the role or academic journey taken. Including a description of the key areas of expertise, skills excellence and what you did really well within this period."]
];

$technical_skills = [
    "Skill 1",
    "Skill 2",
    "Skill 3"
];

$soft_skills = [
    "Skill 1",
    "Skill 2",
    "Skill 3"
];
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
  <link rel="stylesheet" href="pdfstyle.css">

  <title><?php echo ucwords($first_name) . ' Resume'; ?></title>
</head>
<body>
<div id="whatToPrint" class="grid-container">

    <div class="header">
        <h1><?php echo $first_name.' ' .$last_name; ?></h1>
        <p><?php echo $location. ' ' .$phone. ' ' .$age. ' ' .$gender. ' ' .$race. ' ' .$email;  ?></p>
        <p><?php echo $summary; ?></p>


    </div>

    <div class="timeline">
        <h2>Experience</h2>
        <?php foreach ($experiences as $experience): ?>
            <div class="timeline-item">
                <h3><?php echo $experience['year']; ?> - <?php echo $experience['title']; ?></h3>
                <p><?php echo $experience['description']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="skills">
        <h2>Technical Skills</h2>
        <ul>
            <?php foreach ($technical_skills as $skill): ?>
                <li><?php echo $skill; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="skills">
        <h2>Soft Skills</h2>
        <ul>
            <?php foreach ($soft_skills as $skill): ?>
                <li><?php echo $skill; ?></li>
            <?php endforeach; ?>
        </ul>
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
