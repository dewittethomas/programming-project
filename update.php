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
                <a class="logo" href="/" title="Home">
                    <img src="/images/website/logo.svg" loading="lazy" alt="Home">
                </a>
                <form class="search-container" action="/">
                    <input type="text" placeholder="Search...">
                </form>
                <nav>
                    <a class="nav-icon" href="">
                        <img src="/images/website/shopping-cart.svg" loading="lazy">
                    </a>
                    <a class="nav-icon" href="">
                        <img src="/images/website/profile-picture.svg" loading="lazy">
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <?php
        include 'db_connection.php';

        $sql = "SELECT user_id, name, surname, email, blackliststatus, reason FROM USERS";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blackliststatus'])) {
            foreach ($_POST['blackliststatus'] as $user_id) {
                $sql = "UPDATE USERS SET blackliststatus = 1 WHERE name = '$user_id'";
                $conn->query($sql);
            }
            header("Location: Blacklist.php");
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
                echo "<div class='container-studenten'>";
                echo "<p>" . $row["name"] . "</p>";
                echo "<p>" . $row["surname"] . "</p>";
                echo "<p>" . $row["email"] . "</p>";
                echo "<div class='BlacklistButtons'>";
                    echo "<form method='POST' action='update.php'>";
                    echo "<input type='hidden' name='user_id' value='" . $row["user_id"] . "'>";
                    echo "<button class='toevoegen-button' type='submit' name='blackliststatus' value='" . $row["user_id"] . "'>Toevoegen</button>";
                    echo "</form>";
                    echo "<button class='toevoegen-button' type='button'>Verwijderen</button>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<tr><td colspan='4'>Geen studenten gevonden</td></tr>";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blackliststatus'])) {
            $user_id = $_POST['user_id'];
            $sql = "UPDATE USERS SET blackliststatus = 1 WHERE user_id = '$user_id'";
            $conn->query($sql);
            header("Location: Blacklist.php");
        }
    ?>

    <?php
        
    ?>

    <button class='toevoegen-button' type='button' onclick='myFunction()'>Toevoegen</button>


    <a href="Blacklist.php">
        <button class="toevoegen-button" type="button">Blacklist</button>
    </a>

    <footer>
        <div class="container">
            <div class="footer-container">
                <p><a href="https://www.erasmushogeschool.be/nl">&copy; Erasmushogeschool Brussel 2024</a></p>
                
                <ul class="pages">
                    <li><a href="Voorwaarde.html">Voorwaarden</a></li>
                    <li><a href="contact.html">Contact</a></li>
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
