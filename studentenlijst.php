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
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover, .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        function showModal(studentId) {
            document.getElementById('studentIdInput').value = studentId;
            document.getElementById('myModal').style.display = "block";
        }

        function closeModal() {
            document.getElementById('myModal').style.display = "none";
        }
    </script>
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
                    <li><a href="blacklist.php">Blacklist</a></li>
                    <li><a href="admin-producten.php">Producten</a></li>
                </ul>
            </div>
        </div>
    </header>

    <?php
    include 'includes/connect.php';

    $sql = "SELECT user_id, firstname, lastname, email, blackliststatus, reason FROM USERS";
    $result = $conn->query($sql);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reason'])) {
        $user_id = $_POST['user_id'];
        $reason = $_POST['reason'];
        $sql = "UPDATE USERS SET reason = ?, blackliststatus = 1 WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $reason, $user_id);
        $stmt->execute();
        $stmt->close();
        header("Location: studentenlijst.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blacklistVerwijder'])) {
        $user_id = $_POST['user_id'];
        $sql = "UPDATE USERS SET blackliststatus = 0 WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
        header("Location: studentenlijst.php");
        exit();
    }
    ?>

    <div class="container-blacklist">
        <p>Voornaam student</p>
        <p>Achternaam student</p>
        <p>Mail student</p>
        <p>Blacklisten</p>
    </div>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='container-studenten'>";
                echo "<p>" . $row["firstname"] . "</p>";
                echo "<p>" . $row["lastname"] . "</p>";
                echo "<p>" . $row["email"] . "</p>";
                echo "<div class='BlacklistButtons'>";
                    echo "<button class='toevoegen-button' type='button' onclick='showModal(" . $row["user_id"] . ")'>Toevoegen</button>";
                    echo "<form method='POST' action='studentenlijst.php'>";
                    echo "<input type='hidden' name='user_id' value='" . $row["user_id"] . "'>";
                    echo "<button class='toevoegen-button' type='submit' name='blacklistVerwijder' value='" . $row["user_id"] . "'>Verwijderen</button>";
                    echo "</form>";
                echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<tr><td colspan='4'>Geen studenten gevonden</td></tr>";
    }

    echo "<div class='BlacklistButtons'>";
        echo "<button><a href='blacklist.php'>Blacklist</a></button>";
    echo "</div>";

    ?>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form method="POST" action="studentenlijst.php">
                <input type="hidden" id="studentIdInput" name="user_id">
                <label for="reason">Reden:</label>
                <input type="text" id="reason" name="reason" required>
                <button type="submit">Opslaan</button>
            </form>
        </div>
    </div>

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
