<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Beheerder Medialab</title>
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
                </ul>
            </div>
        </div>
    </header>
    <div class="reservation-container">
        <?php
        include 'includes/connect.php';

        // Controleer of er een delete request is gemaakt
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
            $delete_id = intval($_POST['delete_id']);
            $delete_sql = "DELETE FROM RESERVERINGEN WHERE reservatie_id = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $delete_id);
            if ($stmt->execute()) {
                echo "<script>alert('Reservatie succesvol verwijderd.'); window.location.href = '';</script>";
            } else {
                echo "Fout bij het verwijderen van de reservatie.";
            }
        }

        // SQL query om alle aankomende reservaties op te halen, gesorteerd op begindatum, met product status 1
        $sql_reservaties = "SELECT r.reservatie_id, r.product_id, r.user_id, r.begindatum, r.einddatum, 
                            p.name as product_name, p.image as product_image, p.brand as product_brand, p.status as product_status,
                            u.firstname as user_first_name,u.lastname as user_last_name, u.email as user_email
                        FROM RESERVERINGEN r
                        JOIN PRODUCTS p ON r.product_id = p.id
                        JOIN USERS u ON r.user_id = u.user_id
                        WHERE p.status = 1
                        ORDER BY r.begindatum";
        $result_reservaties = $conn->query($sql_reservaties);

        $reservations = [];
        if ($result_reservaties->num_rows > 0) {
            while($row = $result_reservaties->fetch_assoc()) {
                $reservations[$row['begindatum']][] = $row;
            }
        } else {
            echo "Geen aankomende reservaties gevonden.";
        }

        // SQL query om alle inleveringen op te halen, gesorteerd op einddatum
        $sql_inleveringen = "SELECT r.reservatie_id, r.product_id, r.user_id, r.begindatum, r.einddatum, 
                            p.name as product_name, p.image as product_image, p.brand as product_brand, p.status as product_status,
                            u.firstname as user_first_name,u.lastname as user_last_name, u.email as user_email
                        FROM RESERVERINGEN r
                        JOIN PRODUCTS p ON r.product_id = p.id
                        JOIN USERS u ON r.user_id = u.user_id
                        ORDER BY r.einddatum";
        $result_inleveringen = $conn->query($sql_inleveringen);

        $inleveringen = [];
        if ($result_inleveringen->num_rows > 0) {
            while($row = $result_inleveringen->fetch_assoc()) {
                $inleveringen[$row['einddatum']][] = $row;
            }
        } else {
            echo "Geen aankomende inleveringen gevonden.";
        }

        $today = date('Y-m-d');

        // Doorloop de gesorteerde reservaties en toon ze
        echo '<h1>Reservaties</h1>';
        foreach ($reservations as $date => $reservationList) {
            echo '<div class="reservation-group">';
            echo '<div class="reservation-header">Reservaties ' . date('j F Y', strtotime($date)) . '</div>';
            foreach ($reservationList as $reservation) {
                // Controleer of de begindatum is verstreken
                $expiredClass = (strtotime($reservation["begindatum"]) < strtotime($today)) ? 'expired' : '';

                echo '<div class="reservation-item ' . $expiredClass . '">';
                // Productafbeelding weergeven indien beschikbaar
                $imagePath = 'images/' . $reservation["product_image"]; // Pad naar de afbeelding
                if (file_exists($imagePath)) {
                    echo '<img src="' . $imagePath . '" alt="" />';
                } else {
                    echo '<img src="images/no-image-available.png" alt="" />';
                }
                echo '<div class="reservation-details">';
                echo '<h2>' . $reservation["product_name"] . '</h2>';
                echo '<p><strong>Merk:</strong> ' . $reservation["product_brand"] . '</p>';
                echo '<p><strong>Naam:</strong> ' . $reservation["user_first_name"] . ' ' . $reservation["user_last_name"] . '</p>';
                echo '<p><strong>Email:</strong> ' . $reservation["user_email"] . '</p>';
                echo '<p><strong>Periode:</strong> ' . date('d/m/Y', strtotime($reservation["begindatum"])) . ' tot ' . date('d/m/Y', strtotime($reservation["einddatum"])) . '</p>';
                echo '<p><strong>ArtNr:</strong> ' . $reservation["product_id"] . '</p>';
                echo '</div>';
                // Delete button with form
                echo '<form method="POST" action="" onsubmit="return confirm(\'Weet je zeker dat je deze reservatie wilt verwijderen?\');">';
                echo '<input type="hidden" name="delete_id" value="' . $reservation["reservatie_id"] . '">';
                echo '<button type="submit" class="delete-button">🗑️</button>';
                echo '</form>';
                echo '</div>';
            }
            echo '</div>';
        }

        // Doorloop de gesorteerde inleveringen en toon ze
        echo '<h1>Inleveringen</h1>';
        foreach ($inleveringen as $date => $inleveringList) {
            echo '<div class="reservation-group">';
            echo '<div class="reservation-header">Inleveringen ' . date('j F Y', strtotime($date)) . '</div>';
            foreach ($inleveringList as $inlevering) {
                // Controleer of de einddatum is verstreken
                $expiredClass = (strtotime($inlevering["einddatum"]) < strtotime($today)) ? 'expired' : '';

                echo '<div class="reservation-item ' . $expiredClass . '">';
                // Productafbeelding weergeven indien beschikbaar
                $imagePath = 'images/' . $inlevering["product_image"]; // Pad naar de afbeelding
                if (file_exists($imagePath)) {
                    echo '<img src="' . $imagePath . '" alt="" />';
                } else {
                    echo '<img src="images/no-image-available.png" alt="" />';
                }
                echo '<div class="reservation-details">';
                echo '<h2>' . $inlevering["product_name"] . '</h2>';
                echo '<p><strong>Merk:</strong> ' . $inlevering["product_brand"] . '</p>';
                echo '<p><strong>Naam:</strong> ' . $inlevering["user_first_name"] . ' '. $inlevering["user_last_name"] .'</p>';
                echo '<p><strong>Email:</strong> ' . $inlevering["user_email"] . '</p>';
                echo '<p><strong>Periode:</strong> ' . date('d/m/Y', strtotime($inlevering["begindatum"])) . ' tot ' . date('d/m/Y', strtotime($inlevering["einddatum"])) . '</p>';
                echo '<p><strong>ArtNr:</strong> ' . $inlevering["product_id"] . '</p>';
                echo '</div>';
                // Delete button with form
                echo '<form method="POST" action="" onsubmit="return confirm(\'Weet je zeker dat je deze inlevering wilt verwijderen?\');">';
                echo '<input type="hidden" name="delete_id" value="' . $inlevering["reservatie_id"] . '">';
                echo '<button type="submit" class="delete-button">🗑️</button>';
                echo '</form>';
                echo '</div>';
            }
            echo '</div>';
        }

        $conn->close();
        ?>
    </div>



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