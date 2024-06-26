<?php
    require 'includes/session.php';
    require 'includes/products.php';
    require 'includes/categories.php';
    require 'includes/pages.php';
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
                <a class="logo" href="/" title="Home">
                    <img src="/images/website/logo.svg" loading="lazy" alt="Home">
                </a>
                <nav>
                    <a class="nav-icon" href="winkelmand.php">
                        <img src="/images/website/shopping-cart.svg" loading="lazy">
                    </a>
                    <a class="nav-icon" href="/includes/log-out.php">
                        <img src="/images/website/profile-picture.svg" loading="lazy">
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <main>
    <div class="reservation-container">
        <?php
        include 'includes/connect.php';
        if (!isset($_SESSION['user_id'])) {
            echo "Je moet ingelogd zijn om deze pagina te bekijken.";
            exit;
        }

        $user_id = $_SESSION['user_id'];

        $sql_reservations = "SELECT r.reservation_id, r.product_id, r.user_id, r.start_date, r.end_date, 
                            p.name as product_name, p.image as product_image, p.brand as product_brand, p.status as product_status,
                            u.first_name as user_first_name,u.last_name as user_last_name, u.email as user_email
                        FROM RESERVATIONS r
                        JOIN PRODUCTS p ON r.product_id = p.id
                        JOIN USERS u ON r.user_id = u.user_id
                        WHERE r.user_id = ? AND p.status = 1
                        ORDER BY r.start_date";
        $stmt = $conn->prepare($sql_reservations);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result_reservations = $stmt->get_result();

        $reservations = [];
        if ($result_reservations->num_rows > 0) {
            while($row = $result_reservations->fetch_assoc()) {
                $reservations[$row['start_date']][] = $row;
            }
        } else {
            echo "Geen aankomende reservaties gevonden.";
        }

        $sql_inleveringen = "SELECT r.reservation_id, r.product_id, r.user_id, r.start_date, r.end_date, 
                            p.name as product_name, p.image as product_image, p.brand as product_brand, p.status as product_status,
                            u.first_name as user_first_name,u.last_name as user_last_name, u.email as user_email
                        FROM RESERVATIONS r
                        JOIN PRODUCTS p ON r.product_id = p.id
                        JOIN USERS u ON r.user_id = u.user_id
                        WHERE r.user_id = ? AND r.end_date >= CURDATE()
                        ORDER BY r.end_date";
        $stmt = $conn->prepare($sql_inleveringen);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result_inleveringen = $stmt->get_result();

        $inleveringen = [];
        if ($result_inleveringen->num_rows > 0) {
            while($row = $result_inleveringen->fetch_assoc()) {
                $inleveringen[$row['end_date']][] = $row;
            }
        } else {
            echo "Geen aankomende inleveringen gevonden.";
        }

        $today = date('Y-m-d');

        echo '<h1>Mijn Reservaties</h1>';
        foreach ($reservations as $date => $reservationList) {
            echo '<div class="reservation-group">';
            echo '<div class="reservation-header">Reservaties ' . date('j F Y', strtotime($date)) . '</div>';
            foreach ($reservationList as $reservation) {
                // Controleer of de startdatum is verstreken
                $expiredClass = (strtotime($reservation["start_date"]) < strtotime($today)) ? 'expired' : '';

                echo '<div class="reservation-item ' . $expiredClass . '">';
                // Productafbeelding weergeven indien beschikbaar
                $imagePath = 'images/' . $reservation["product_image"];
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
                echo '</div>';
            }
            echo '</div>';
        }


        echo '<h1>Mijn Inleveringen</h1>';
        foreach ($inleveringen as $date => $inleveringList) {
            echo '<div class="reservation-group">';
            echo '<div class="reservation-header">Inleveringen ' . date('j F Y', strtotime($date)) . '</div>';
            foreach ($inleveringList as $inlevering) {
                // Controleer of de einddatum is verstreken
                $expiredClass = (strtotime($inlevering["end_date"]) < strtotime($today)) ? 'expired' : '';

                echo '<div class="reservation-item ' . $expiredClass . '">';
                // Productafbeelding weergeven indien beschikbaar
                $imagePath = 'images/' . $inlevering["product_image"]; 
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
                echo '<p><strong>Periode:</strong> ' . date('d/m/Y', strtotime($inlevering["start_date"])) . ' tot ' . date('d/m/Y', strtotime($inlevering["end_date"])) . '</p>';
                echo '<p><strong>ArtNr:</strong> ' . $inlevering["product_id"] . '</p>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }

        $conn->close();
        ?>
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