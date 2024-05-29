<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Uitleendienst MediaLab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/main.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
</head>
<body>
<header>
        <div class="header-top">
            <div class="container">
                <a class="logo" href="/" title="Home">
                    <img src="/images/website/logo.svg" loading="lazy" alt="Home">
                </a>
                <form class="search-container" action="/">
                    <input class="search-glass" type="text" placeholder="Search...">
                </form>
                <nav>
                    <a class="nav-icon" href="winkelmandje.php">
                        <img src="/images/website/shopping-cart.svg" loading="lazy">
                    </a>
                    <a class="nav-icon" href="">
                        <img src="/images/website/profile-picture.svg" loading="lazy">
                    </a>
                </nav>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <form class="search-container" action="/">
                    <input type="text" placeholder="Search...">
                </form>
                <ul class="category-container">
                    <div class="dropdown-container">
                        <li class="dropdown-item"><a href="">Video</a></li>

                        <div class="dropdown-content">
                            <div class="container">
                                <div class="dropdown-row">
                                    <a class="category" href="#">Camera's</a>
                                    <a href="#">Dieptecamera</a>
                                    <a href="#">Overige</a>
                                </div>
                            </div>
                        </div>
                    </div> 
                    
                    <li><a href="gezochte_producten.php?category=Audio">Audio</a></li>
        <li><a href="gezochte_producten.php?category=Belichting">Belichting</a></li>
        <li><a href="gezochte_producten.php?category=Tools">Tools</a></li>
        <li><a href="gezochte_producten.php?category=Varia">Varia</a></li>
        <li><a href="gezochte_producten.php?category=XR">XR</a></li>
  
                </ul>
            </div>
        </div>
    </header>

    <main>
    
    <?php
    
    session_start();
    include 'includes/connect.php';
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Check if search results are available
    if (isset($_SESSION['search_results'])) {
        echo "<div class='product-container'>";
        foreach ($_SESSION['search_results'] as $product) {
            echo '<div class="product">';
            echo "<a href='artikel.php?id=" . $product['id'] . "'>";
            echo "<h2>" . htmlspecialchars($product["name"]) . "</h2>";
            if (!empty($product["image"])) {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($product["image"]) . '" /><br>';
            } else {
                echo "Geen afbeelding beschikbaar<br>";
            }
            echo '</a>';
            echo '</div>';
        }
        echo "</div>";
        unset($_SESSION['search_results']);
    }
    
    // Check if there are no search results
    if (isset($_GET['no_results']) && $_GET['no_results'] === 'true') {
        echo "<p>No products found for your search.</p>";
    }
    
    // Fetch products based on category
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
    
        $sql = "SELECT P.id, P.name, P.image
                FROM PRODUCTS P
                JOIN SUBCATEGORY S ON P.subcategory_id = S.subcategory_id
                WHERE S.category = ?";
    
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result === false) {
                die("Error executing query: " . $conn->error);
            }
    
            echo "<div class='product-container'>";
            echo "<h2>Products in Category: " . htmlspecialchars($category) . "</h2>";
            echo "<br>";
            echo "<br>";    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product">';
                    echo "<a href='artikel.php?id=" . $row['id'] . "'>";
                    echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                    if (!empty($row['image'])) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" /><br>';
                    } else {
                        echo "Geen afbeelding beschikbaar<br>";
                    }
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo "Geen producten gevonden in deze categorie.";
            }
    
            echo "</div>";
    
            $stmt->close();
        } else {
            die("Failed to prepare the SQL statement: " . $conn->error);
        }
    }
    // Fetch products based on category
    if (isset($_GET['subcategory'])) {
        $category = $_GET['subcategory'];
    
        $sql = "SELECT P.id, P.name, P.image
                FROM PRODUCTS P
                JOIN SUBCATEGORY S ON P.subcategory_id = S.subcategory_id
                WHERE S.subcategory = ?";
    
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $category);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result === false) {
                die("Error executing query: " . $conn->error);
            }
    
            echo "<div class='product-container'>";
            echo "<h2>Products in Category: " . htmlspecialchars($category) . "</h2>";
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product">';
                    echo "<a href='artikel.php?id=" . $row['id'] . "'>";
                    echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                    if (!empty($row['image'])) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" /><br>';
                    } else {
                        echo "Geen afbeelding beschikbaar<br>";
                    }
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo "Geen producten gevonden in deze categorie.";
            }
    
            echo "</div>";
    
            $stmt->close();
        } else {
            die("Failed to prepare the SQL statement: " . $conn->error);
        }
    }
    
    $conn->close();
    ?>
    

    </main>
    <footer>
        <p>&copy; Erasmushogeschool Brussel 2024</p>
    </footer>
</body>
</html>
