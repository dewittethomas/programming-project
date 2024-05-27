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

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blackliststatus'])) {
            foreach ($_POST['blackliststatus'] as $id) {
                $sql = "UPDATE PERSONEN SET blackliststatus = 1 WHERE voornaam = $id";
                $conn->query($sql);
            }
            header("Location: studenten_overzicht.php");
        }
        
        $sql = "SELECT voornaam, achternaam, email, blackliststatus FROM PERSONEN";
        $result = $conn->query($sql);

    ?>

    <table border="1">
        <tr>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>Email</th>
            <th>Blacklist</th>
        </tr>
        <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["voornaam"] . "</td>";
                    echo "<td>" . $row["achternaam"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td><input type='checkbox' name='blacklist[]' value='" . $row["voornaam"] . "'" . ($row["blackliststatus"] ? " checked" : "") . "></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Geen studenten gevonden</td></tr>";
            }
        ?>
    </table>

    <div class="container-blacklist">
        <p>Voornaam student</p>
        <p>Achternaam student</p>
        <p>Mail student</p>
        <p>Reden</p>
    </div>

    <button class="toevoegen-button" type="button" onclick="addStudent()">Voeg student toe</button>

    <?php
        function addStudent() {
            // Code to add a student goes here
        }
    ?>

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