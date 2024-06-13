<?php

define('Token', 'HGsZOXpfNC');
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
    $experience = $_POST['experience'];

    $profile = isset($_POST['profile']) ? $_POST['profile'] : 'default-profile.png';
    $skills = [];
    $skill_levels = [];
// in the place of $skills ypu will have
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST["skill$i"]) && isset($_POST["skill_level$i"])) {
            $skill = $_POST["skill$i"];
            $skill_level = $_POST["skill_level$i"];

            // Ensure the fields are not empty
            if (!empty($skill) && !empty($skill_level)) {
                $skills[] = $skill;
                $skill_levels[] = $skill_level;
            }
        }
    }

    $experiences = [];
    for ($i = 1; $i <= 3; $i++) {
        if (isset($_POST["title$i"]) && isset($_POST["description$i"]) && isset($_POST["year$i"])) {
            $title = $_POST["title$i"];
            $description = $_POST["description$i"];
            $year = $_POST["year$i"];

            if (!empty($title) && !empty($description) && !empty($year)) {
                $experiences[] = [
                    "title" => $title,
                    "description" => $description,
                    "year" => $year
                ];

    $soft_skills = [];
    $soft_skill_levels = [];
// in the place of $skills ypu will have
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST["soft_skill$i"]) && isset($_POST["skill_level$i"])) {
            $soft_skill = $_POST["soft_skill$soft_skill$i"];
            $soft_skill_level = $_POST["soft_skill_level$i"];

            // Ensure the fields are not empty
            if (!empty($skill) && !empty($soft_skill_level)) {
                $soft_skills[] = $soft_skill;
                $soft_skill_levels[] = $soft_skill_level;

            }
        }
    }
}
?>

<?php
// PHP variables for the CV content
$name = "Name & Surname";
$contact_details = " Town, Province | Cell number | Age / Sex / Race | email address";
$summary = "Summary of the individual – This is a space to express your passion, development, and ambition within your career. A creative story telling segment that showcases not just your interests, but capabilities as unique individual wanting to make an impact for the future!";


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

    <!-- Displaying the skills -->
    <?php if (!empty($skills)): ?>
        <div class="skills">
            <h2>Technical Skills</h2>
            <ul>
                <?php foreach ($skills as $skill): ?>
                    <li><?php echo htmlspecialchars($skill); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

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
