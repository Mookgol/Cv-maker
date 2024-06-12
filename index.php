<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .info-icon {
            position: relative;
            display: inline-block;
            cursor: pointer;
            color: #0d6efd;
            margin-left: 5px;
        }

        .info-icon .info-box {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            color: #000;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 200px;
            top: 20px;
            left: 0;
            z-index: 1;
        }

        .info-icon:hover .info-box {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container text-light">
        <h1 class="text-center my-5 fw-bold">Resume Form</h1>
        <div class="form-container">
            <form action="submit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="token" value="HGsZOXpfNC">
                <h2>Cv Questions</h2>
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <label class="form-label">First Name
                            <span class="info-icon">i<i class="fa-solid fa-circle-info"></i>
                                <span class="info-box">Enter your first name as it appears on official documents.</span>
                            </span>
                        </label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>
                    <div>
                        <label class="form-label">Last Name
                            <span class="info-icon">i
                                <span class="info-box">Enter your last name as it appears on official documents.</span>
                            </span>
                        </label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Location (Area and Province)
                        <span class="info-icon">i
                            <span class="info-box">Enter the area and province where you currently reside.</span>
                        </span>
                    </label>
                    <input type="text" class="form-control" name="location" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Age
                        <span class="info-icon">i
                            <span class="info-box">Enter your age in years.</span>
                        </span>
                    </label>
                    <input type="number" class="form-control" id="Age" name="age" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender
                        <span class="info-icon">i
                            <span class="info-box">Enter your gender.</span>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="Gender" name="gender" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Race
                        <span class="info-icon">i
                            <span class="info-box">Enter your race.</span>
                        </span>
                    </label>
                    <input type="text" class="form-control" id="race" name="race" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone number
                        <span class="info-icon">i
                            <span class="info-box">Enter your phone number in the format 0712345678.</span>
                        </span>
                    </label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="0712345678" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email address
                        <span class="info-icon">i
                            <span class="info-box">Enter your valid email address. We'll never share your email with anyone else.</span>
                        </span>
                    </label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" id="about_me">Summary
                        <span class="info-icon">i
                            <span class="info-box">Summarize your career ambitions, development goals, and the impact you want to make.</span>
                        </span>
                    </label>
                    <div class="form-floating">
                        <textarea class="form-control" id="summary" name="summary" style="height: 100px" required></textarea>
                    </div>
                </div>
                <input type="submit" class="form-control my-2">
            </form>
        </div>
    </div>
    <script src="app.js"></script>
</body>
</html>
