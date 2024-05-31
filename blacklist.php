<?php
    require 'includes/session.php';
    require 'includes/connect.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Uitleendienst MediaLab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" type="image/x-icon" href="images/website/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-top">
            <div class="container">
                <a class="logo" href="admin.php" title="Home">
                    <img src="/images/website/logo.svg" loading="lazy" alt="Home">
                </a>
                <nav>
                    <a class="nav-icon" href="">
                        <img src="/images/website/profile-picture.svg" loading="lazy">
                    </a>
                </nav>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <ul class="category-container">
                    <li><a href="scanning.php">Scanning</a></li>
                    <li><a href="artikel-toevoegen.php">Artikel toevoegen</a></li>
                    <li><a href ="blacklist.php">Blacklist</a></li>
                    <li><a href ="admin-producten.php">Producten</a></li>
                    <li><a href ="AddUser.php">Nieuwe gebruiker</a></li>
                </ul>
            </div>
        </div>
    </header>

    <?php
        $sql = "SELECT user_id, firstname, lastname, email, blackliststatus, reason FROM USERS";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blackliststatus'])) {
            foreach ($_POST['blackliststatus'] as $user_id) {
                $sql = "UPDATE USERS SET blackliststatus = 1 WHERE name = '$user_id'";
                $conn->query($sql);
            }
            header("Location: blacklist.php");
        }
        
        $result = $conn->query($sql);

    ?>

    <div class="container-blacklist">
        <p>Voornaam student</p>
        <p>Achternaam student</p>
        <p>Mail student</p>
        <p>Reden</p>
    </div>

    <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["blackliststatus"] == 1) {
                    echo "<div class='container-studenten'>";
                    echo "<p>" . $row["firstname"] . "</p>";
                    echo "<p>" . $row["lastname"] . "</p>";
                    echo "<p>" . $row["email"] . "</p>";
                    echo "<p>" . $row["reason"] . "</p>";
                    echo "</div>";
                }
            }
        } else {
            echo "<tr><td colspan='4'>Geen studenten gevonden</td></tr>";
        }
    ?>

    <a href="studentenlijst.php">
        <button class="toevoegen-button" type="button">Studentenlijst</button>
    </a>

    <footer>
        <div class="container">
            <div class="footer-container">
                <p>&copy; Erasmushogeschool Brussel 2024</p>
                
                <ul class="pages">
                    <li><a href="voorwaarden.php">Voorwaarden</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>

                <div class="socials">
                    <a class="footer-icon" href="https://www.facebook.com/erasmushogeschool" target="_blank">
                        <img src="/images/website/facebook.png" loading="lazy" alt="">
                    </a>
                    <a class="footer-icon" href="https://www.linkedin.com/school/erasmushogeschool-brussel/" target="_blank">
                        <img src="/images/website/linkedin.png" loading="lazy" alt="">
                    </a>
                    <a class="footer-icon" href="https://twitter.com/ehbrussel" target="_blank">
                        <img src="/images/website/twitter.png" loading="lazy" alt="">
                    </a>
                    <a class="footer-icon" href="https://www.instagram.com/erasmushogeschool/" target="_blank">
                        <img src="/images/website/instagram.png" loading="lazy" alt="">
                    </a>
                    <a class="footer-icon" href="https://www.youtube.com/user/ehbrussel" target="_blank">
                        <img src="/images/website/youtube.png" loading="lazy" alt="">
                    </a>
                    <a class="footer-icon" href="https://www.flickr.com/photos/erasmushogeschool" target="_blank">
                        <img src="/images/website/flickr.png" loading="lazy" alt="">
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>