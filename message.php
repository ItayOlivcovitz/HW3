<?php
$key = $_GET['key'];
$email = $_GET['email'];
?>
<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body class="main-body bg-info bg-opacity-25">
    <div class="row mb-5"></div>
    <div class="row mb-5"></div>
    <div class="container border border-2 bg-info bg-opacity-25">

        <div class="row mb-1 mt-2">
            <p class="text-info-emphasis" style="font-size: 18px;">היי ൬aster,</p>
        </div>
        <div class="row mb-5"></div>
        <div class="row mb-5"></div>
        <div class="row justify-content-center">
            <div class="col-10">
                <p class="text-center  text-info-emphasis">
                    התקבלה בקשה חדשה עבור כתובת האימייל הזו לשחזור הסיסמא לאתר Ṭask൬aster. להמשך הפעולה יש
                    <a style="font-size: 16px; font-weight: bold;" href="set_password.php?key=<?= $key; ?>&email=<?= $email; ?>">ללחוץ כאן</a>
                    <br><br>
                    אם לא בוצעה בקשה לשחזור הסיסמא, נא להתעלם מהמייל הזה.<br> ניתן ליצור איתנו קשר דרך האתר.
                </p>
            </div>
        </div>
        <div class="row mb-5"></div>
        <div class="row mb-5"></div>
        <div class="row mt-2 mb-2">
            <a class="navbar-brand display-6 text-info-emphasis" href="index.php">Ṭask൬aster&copy; 2023</a>
        </div>
    </div>
    <script src="add_bootstrap.js"></script>
</body>

</html>