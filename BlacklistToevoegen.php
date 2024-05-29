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
        include 'includes/connect.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blackliststatus'])) {
            foreach ($_POST['blackliststatus'] as $id) {
                $sql = "UPDATE USERS SET blackliststatus = 1 WHERE name = '$id'";
                $conn->query($sql);
            }
            header("Location: Blacklist.php");
        }
        
        $sql = "SELECT firstname, lastname, email, blackliststatus, reason FROM USERS";
        $result = $conn->query($sql);

    ?>

    <h1>Studenten Overzicht</h1>
    <form method="POST" action="Blacklist.php">
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
                    echo "<div class='studentenLijst'>";
                    echo "<tr>";
                    echo "<input type='hidden' name='user_id' value='500'>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["surname"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td><input type='checkbox' name='blackliststatus[]' value='" . $row["name"] . "'" . ($row["blackliststatus"] ? " checked" : "") . "></td>";
                    echo "</tr>";
                    echo "</div>";
                }
            } else {
                echo "<tr><td colspan='4'>Geen personen op de blacklist</td></tr>";
            }
            ?>

        </table>
        <a href="Blacklist.php">
            <button class="toevoegen-button" type="submit">Bijwerken</button>
        </a>
    </form>


    

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