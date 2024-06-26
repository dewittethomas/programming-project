<?php
    require 'includes/login-process.php'
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
<body class="background">
    <header>
        <div class="container">
            <a class="logo" href="/" title="Home">
                <img src="/images/website/logo.svg" loading="lazy" alt="Home">
            </a>
        </div>
    </header>

    <main>
        <div class="container center">
            <div class="login-container">
                <h2>Inloggen</h2>
                
                <form method="post">
                    <div class="input-container">
                        <label for="username">Gebruikersnaam</label>
                        <input id="username" name="username" type="text">
                        <label for="password">Paswoord</label>
                        <input id="password" name="password" type="password">
                        <button class="submit-button login" type="submit">Inloggen</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>