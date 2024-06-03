<?php
    require "includes/session.php";

    if ($_SESSION["user_role"] != "admin") {
        header("Location: index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Beheerder MediaLab</title>
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
                    <li><a href="admin.php">Agenda</a></li>
                    <li><a href="scansysteem.php">Scansysteem</a></li>
                    <li><a href="admin-producten.php">Producten</a></li>
                    <li><a href="artikel-toevoegen.php">Artikel toevoegen</a></li>
                    <li class="current-category"><a href="blacklist.php">Blacklist</a></li>
                    <li><a href="waarschuwen.php">Waarschuwen</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="user-container">
                <?php
                    include 'includes/connect.php';
                    if ($conn->connect_error) {
                        die("Verbinding mislukt: " . $conn->connect_error);
                    }
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
                        $userId = $_POST["user_id"];
                        $sql = "UPDATE USERS SET blacklist = 0, warning = 0 WHERE user_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $userId);
                        if ($stmt->execute()) {
                            header("Location: /blacklist.php ");
                            exit;
                        } else {
                            echo "Fout bij het opnieuw instellen van de gebruiker.";
                        }
                    }
                    $sql = "SELECT user_id, first_name, last_name, email, username FROM USERS WHERE blacklist = 1";
                    $result = $conn->query($sql);
                ?>

                <h2>Blacklisted Gebruikers</h2>

                <table>
                    <tr>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>E-mail</th>
                        <th>Gebruikersnaam</th>
                        <th></th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["first_name"] . "</td>";
                            echo "<td>" . $row["last_name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo '<td class="delete-icon-cell"><form method="post" action="'.$_SERVER['PHP_SELF'].'">';
                            echo '<input type="hidden" name="user_id" value="' . $row["user_id"] . '">';
                            echo '<button type="submit" class="delete-icon" onclick="return confirm(\'Weet je zeker dat je deze gebruiker wilt deblokkeren en de waarschuwing wilt resetten?\')">&#10060;</button>';
                            echo '</form></td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Geen blacklisted gebruikers gevonden.</td></tr>";
                    }
                    ?>
</table>
        </div>
    </main>    
<footer>
        <div class="container">
            <div class="footer-container">
                <p>&copy; Erasmushogeschool Brussel 2024</p>
                
                <ul class="links">
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
