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
                    <a class="nav-icon" href="/includes/log-out.php">
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
                    <li><a href="admin-artikels.php">Artikels</a></li>
                    <li><a href="artikel-toevoegen.php">Artikel toevoegen</a></li>
                    <li><a href="blacklist.php">Blacklist</a></li>
                    <li class="current-category"><a href="waarschuwen.php">Waarschuwen</a></li>
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

                    // Verhoog waarschuwing met 1 en update blacklist indien nodig
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["increase_warning_user_id"])) {
                        $userId = $_POST["increase_warning_user_id"];
                        $sql = "UPDATE USERS SET warning = warning + 1 WHERE user_id = ? AND WHERE role = 'student'";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $userId);
                        if ($stmt->execute()) {
                            // Controleer of waarschuwingen 2 of hoger zijn en update blacklist
                            $sql_check_warning = "SELECT warning FROM USERS WHERE user_id = ? AND WHERE role = 'student'";
                            $stmt_check = $conn->prepare($sql_check_warning);
                            $stmt_check->bind_param("i", $userId);
                            $stmt_check->execute();
                            $result_check = $stmt_check->get_result();
                            $row_check = $result_check->fetch_assoc();
                            if ($row_check['warning'] >= 2) {
                                $sql_update_blacklist = "UPDATE USERS SET blacklist = 1 WHERE user_id = ?";
                                $stmt_update = $conn->prepare($sql_update_blacklist);
                                $stmt_update->bind_param("i", $userId);
                                $stmt_update->execute();
                            }
                            header("Location: /waarschuwen.php");
                            exit;
                        } else {
                            echo "Fout bij het verhogen van de waarschuwing.";
                        }
                    }

                    // Selecteer alle gebruikers, alfabetisch gesorteerd
                    $sql = "SELECT user_id, first_name, last_name, email, username, warning FROM USERS WHERE role = 'student' ORDER BY last_name ASC, first_name ASC";

                    $result = $conn->query($sql);
                ?>

                <h2>Alle Gebruikers</h2>

                <table>
                    <tr>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                        <th>E-mail</th>
                        <th>Gebruikersnaam</th>
                        <th>Waarschuwingen</th>
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
                            echo "<td>" . $row["warning"] . "</td>";
                            echo '<td class="warning-icon-cell"><form method="post" action="'.$_SERVER['PHP_SELF'].'">';
                            echo '<input type="hidden" name="increase_warning_user_id" value="' . $row["user_id"] . '">';
                            echo '<button type="submit" class="warning-icon" onclick="return confirm(\'Weet je zeker dat je de waarschuwing van deze gebruiker wilt verhogen?\')">&#9888;</button>';
                            echo '</form></td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Geen gebruikers gevonden.</td></tr>";
                    }
                    ?>
                </table>
            </div>
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
