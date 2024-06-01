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
                    <li><a href ="AddUser.php">Nieuwe gebruiker</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <div class="artikelToevoegen">
            <h1>Nieuwe gebruiker toevoegen</h1>
            <form action="AddUser.php" method="post">
            <label for="firstname">Voornaam:</label>
            <input type="text" id="firstname" name="firstname" required>
            <label for="lastname">Achternaam:</label>
            <input type="text" id="lastname" name="lastname" required>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            <label for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>
            <label for="role">Rol:</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <label for="blackliststatus">Blacklist status:</label>
            <select id="blackliststatus" name="blackliststatus" required>
                <option value="0">Not Blacklisted</option>
                <option value="1">Blacklisted</option>
            </select>
            <button type="submit" class="gebruikerbutton">Toevoegen</button>
            </form>
        </div>
        
        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
            $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
            $email = isset($_POST["email"]) ? $_POST["email"] : "";
            $username = isset($_POST["username"]) ? $_POST["username"] : "";
            $password = isset($_POST["password"]) ? $_POST["password"] : "";
            $role = isset($_POST["role"]) ? $_POST["role"] : "";
            $blackliststatus = isset($_POST["blackliststatus"]) ? $_POST["blackliststatus"] : "";

            include 'includes/connect.php';

            // Prepare and execute SQL query
            $sql = "INSERT INTO USERS (firstname, lastname, email, username, password, role, blackliststatus) VALUES ('$firstname', '$lastname', '$email', '$username', '$password', '$role', '$blackliststatus')";

            if ($blackliststatus === "") {
                $sql = "INSERT INTO USERS (firstname, lastname, email, username, password, role) VALUES ('$firstname', '$lastname', '$email', '$username', '$password', '$role')";
            }

            // Close database connection
            $conn->close();
        }
        ?>
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