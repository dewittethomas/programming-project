<?php
    require "includes/session.php";

    if ($_SESSION["user_role"] != "admin") {
        header("Location: index.php");
        exit;
    }
?>
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
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
                    <li class="current-category"><a href="admin.php">Agenda</a></li>
                    <li><a href="scansysteem.php">Scansysteem</a></li>
                    <li><a href="admin-artikels.php">Artikels</a></li>
                    <li><a href="artikel-toevoegen.php">Artikel toevoegen</a></li>
                    <li><a href="blacklist.php">Blacklist</a></li>
                    <li><a href="waarschuwen.php">Waarschuwen</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="reservation-container">
        <?php
        include 'includes/connect.php';

        // Controleer de verbinding
        if ($conn->connect_error) {
            die("Verbinding mislukt: " . $conn->connect_error);
        }

        // Controleer of er een delete request is gemaakt
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
            $delete_id = intval($_POST['delete_id']);
            $delete_sql = "DELETE FROM RESERVATIONS WHERE reservation_id = ?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $delete_id);
            if ($stmt->execute()) {
                echo "<script>alert('Reservatie succesvol verwijderd.'); window.location.href = '';</script>";
            } else {
                echo "Fout bij het verwijderen van de reservatie.";
            }
        }

        $sql_reservations = "SELECT r.reservation_id, r.product_id, r.user_id, r.start_date, r.end_date, 
                            p.name as product_name, p.image as product_image, p.brand as product_brand, p.status as product_status,
                            u.first_name as user_first_name, u.last_name as user_last_name, u.email as user_email, u.warning, u.blacklist
                        FROM RESERVATIONS r
                        JOIN PRODUCTS p ON r.product_id = p.id
                        JOIN USERS u ON r.user_id = u.user_id
                        WHERE p.status = 1
                        ORDER BY r.start_date";
        $result_reservations = $conn->query($sql_reservations);

        $reservations = [];
        if ($result_reservations->num_rows > 0) {
            while($row = $result_reservations->fetch_assoc()) {
                $reservations[$row['start_date']][] = $row;
            }
        }

        
        $sql_inleveringen = "SELECT r.reservation_id, r.product_id, r.user_id, r.start_date, r.end_date, 
                            p.name as product_name, p.image as product_image, p.brand as product_brand, p.status as product_status,
                            u.first_name as user_first_name, u.last_name as user_last_name, u.email as user_email, u.warning, u.blacklist, r.warning_issued
                        FROM RESERVATIONS r
                        JOIN PRODUCTS p ON r.product_id = p.id
                        JOIN USERS u ON r.user_id = u.user_id
                        ORDER BY r.end_date";
        $result_inleveringen = $conn->query($sql_inleveringen);

        $inleveringen = [];
        if ($result_inleveringen->num_rows > 0) {
            while($row = $result_inleveringen->fetch_assoc()) {
                $inleveringen[$row['end_date']][] = $row;
            }
        }

        $today = date('Y-m-d');

        ?>
        <h1>Reservaties</h1>
        <?php
        if (empty($reservations)) {
            echo '<div class="no-reservations">Geen aankomende reservaties gevonden.</div>';
        } else {
            foreach ($reservations as $date => $reservationList) {
                echo '<div class="reservation-group">';
                echo '<div class="reservation-header">Reservaties ' . date('j F Y', strtotime($date)) . '</div>';
                foreach ($reservationList as $reservation) {
                    // Controleer of de begindatum is verstreken
                    $expiredClass = (strtotime($reservation["start_date"]) < strtotime($today)) ? 'expired' : '';

                    echo '<div class="reservation-item ' . $expiredClass . '">';
                    // Productafbeelding weergeven indien beschikbaar
                    $imagePath = 'images/products/' . $reservation["product_image"];
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
                    echo '<p><strong>Periode:</strong> ' . date('d/m/Y', strtotime($reservation["start_date"])) . ' tot ' . date('d/m/Y', strtotime($reservation["end_date"])) . '</p>';
                    echo '<p><strong>ArtNr:</strong> ' . $reservation["product_id"] . '</p>';
                    echo '</div>';
                    // Delete button with form
                    echo '<form method="POST" action="" onsubmit="return confirm(\'Weet je zeker dat je deze reservatie wilt verwijderen?\');">';
                    echo '<input type="hidden" name="delete_id" value="' . $reservation["reservation_id"] . '">';
                    echo '<button type="submit" class="delete-button">&#10060;</button>';
                    echo '</form>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }

        ?>
        <h1>Inleveringen</h1>
        <?php
        if (empty($inleveringen)) {
            echo '<div class="no-reservations">Geen aankomende inleveringen gevonden.</div>';
        } else {
            foreach ($inleveringen as $date => $inleveringList) {
                echo '<div class="reservation-group">';
                echo '<div class="reservation-header">Inleveringen ' . date('j F Y', strtotime($date)) . '</div>';
                foreach ($inleveringList as $inlevering) {
                    // Controleer of de einddatum is verstreken en of de waarschuwing al is uitgegeven
                    $expiredClass = (strtotime($inlevering["end_date"]) < strtotime($today)) ? 'expired' : '';

                    echo '<div class="reservation-item ' . $expiredClass . '">';
                    // Verhoog de waarschuwing als de einddatum is verstreken en de waarschuwing nog niet is uitgegeven
                    if ($expiredClass && !$inlevering["warning_issued"]) {
                        $user_id = $inlevering["user_id"];
                        $reservation_id = $inlevering["reservation_id"];

                    
                        $conn->begin_transaction();

                        try {
                            // Verhoog de waarschuwing

                            $update_warning_sql = "UPDATE USERS SET warning = warning + 1 WHERE user_id = ? AND WHERE role = 'student'";
                            $stmt_warning = $conn->prepare($update_warning_sql);
                            $stmt_warning->bind_param("i", $user_id);
                            $stmt_warning->execute();

                            // Haal het bijgewerkte aantal waarschuwingen op
                            $select_warning_sql = "SELECT warning FROM USERS WHERE user_id = ? AND WHERE role = 'student'";
                            $stmt_select_warning = $conn->prepare($select_warning_sql);
                            $stmt_select_warning->bind_param("i", $user_id);
                            $stmt_select_warning->execute();
                            $result_warning = $stmt_select_warning->get_result();
                            $row_warning = $result_warning->fetch_assoc();
                            $warning_count = $row_warning['warning'];

                            // Update de reservation om aan te geven dat de waarschuwing is uitgegeven
                            $update_reservation_sql = "UPDATE RESERVATIONS SET warning_issued = TRUE WHERE reservation_id = ?";
                            $stmt_reservation = $conn->prepare($update_reservation_sql);
                            $stmt_reservation->bind_param("i", $reservation_id);
                            $stmt_reservation->execute();

                            // Zet de gebruiker op de zwarte lijst als ze 2 waarschuwingen hebben bereikt
                            if ($warning_count >= 2) {
                                $update_blacklist_sql = "UPDATE USERS SET blacklist = 1 WHERE user_id = ? AND WHERE role = 'student'";
                                $stmt_blacklist = $conn->prepare($update_blacklist_sql);
                                $stmt_blacklist->bind_param("i", $user_id);
                                $stmt_blacklist->execute();
                            }

                            // Commit de transactie
                            $conn->commit();
                        } catch (Exception $e) {
                            
                            $conn->rollback();
                            echo "Er is een fout opgetreden bij het verwerken van de waarschuwingen: " . $e->getMessage();
                        }
                    }

                    // Productafbeelding weergeven indien beschikbaar
                    $imagePath = 'images/products/' . $inlevering["product_image"];
                    if (file_exists($imagePath)) {
                        echo '<img src="' . $imagePath . '" alt="" />';
                    } else {
                        echo '<img src="/images/products/not-found.jpg" alt="" />';
                    }
                    echo '<div class="reservation-details">';
                    echo '<h2>' . $inlevering["product_name"] . '</h2>';
                    echo '<p><strong>Merk:</strong> ' . $inlevering["product_brand"] . '</p>';
                    echo '<p><strong>Naam:</strong> ' . $inlevering["user_first_name"] . ' '. $inlevering["user_last_name"] .'</p>';
                    echo '<p><strong>Email:</strong> ' . $inlevering["user_email"] . '</p>';
                    echo '<p><strong>Periode:</strong> ' . date('d/m/Y', strtotime($inlevering["start_date"])) . ' tot ' . date('d/m/Y', strtotime($inlevering["end_date"])) . '</p>';
                    echo '<p><strong>ArtNr:</strong> ' . $inlevering["product_id"] . '</p>';
                    echo '</div>';
                    // Delete button with form
                    echo '<form method="POST" action="" onsubmit="return confirm(\'Weet je zeker dat je deze inlevering wilt verwijderen?\');">';
                    echo '<input type="hidden" name="delete_id" value="' . $inlevering["reservation_id"] . '">';
                    echo '<button type="submit" class="delete-button">&#10060;</button>';
                    echo '</form>';
                    echo '</div>';
                }
                echo '</div>';
            }
        }

        $conn->close();
        ?>
        </div>

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
