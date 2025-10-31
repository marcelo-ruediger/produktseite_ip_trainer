<?php 
session_start(); // Start session for one-time messages
require_once "config.php"; //Make sure the config file has the right name!
// Connect
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS test";
$conn->query($sql);

//Select the database
$conn->select_db("test");

// Create DB table if it doesn't exist 
$sql_table = "CREATE TABLE IF NOT EXISTS rezensionen (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
rating INT NOT NULL,
comment VARCHAR(300),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$conn->query($sql_table);

// Handle form submission
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'] ?? NULL;
    $comment = $_POST['comment'] ?? '';

    if ($rating) {
        // do not pass directly the variable ratings and comment, risk of SQL Injectios. ? -> place holders
        $stmt = $conn->prepare("INSERT INTO rezensionen (rating, comment) VALUES (?, ?)"); //use prepare then bind params
        $stmt->bind_param("is", $rating, $comment); 

        if ($stmt->execute()) {
            // Save success message in session (will be shown once)
            $_SESSION['success_message'] = "Vielen Dank für Ihre Bewertung!";
            $stmt->close();
            mysqli_close($conn);
            
            // Redirect to prevent reload resubmission (with anchor)
            header("Location: index.php#rezensionen");
            exit();
        }
        $stmt->close();
    }
}

// Show success message from session (only once)
$success_message = "";
$error_message = "";

if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Remove message after showing it once
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>IP-Trainer Verkaufseite</title>
        <link rel="stylesheet" href="./css/main.css" />
        <link rel="stylesheet" href="./css/nav.css" />
        <link rel="stylesheet" href="./css/ratings.css" />
    </head>
    <body>
        <header>
            <a href="#jetzt-herunterladen" class="marke hover-effect">
                <img
                    src="./images/ip_icon_138457.png"
                    alt="IP icon"
                    class="white-icon"
                />
                TRAINER
            </a>
            <nav class="burger-nav">
                <div class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="nav-menu">
                    <li><a href="#features">Features</a></li>
                    <li>
                        <a href="#jetzt-herunterladen">Download</a>
                    </li>
                    <li><a href="#rezensionen">Rezensionen</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <section id="top-section">
                <div>
                    <h1>
                        <span class="purple-marker"
                            >Übung macht den Meister</span
                        >
                    </h1>
                    <br />
                    <h2>IP-Training für die IHK direkt in deiner Tasche</h2>
                    <h3>
                        Lerne flexibel unterwegs und festige dein Wissen zu
                        Subnetting und IP-Adressen.
                    </h3>
                    <a class="button-link" href="#features">Mehr erfahren</a>
                </div>
                <img
                    src="./images/app_phone.png"
                    alt="Phone with App running on screen"
                    class="img-shadow"
                />
            </section>
            <hr />
            <section>
                <h2>
                    Werde zum
                    <span class="purple-marker">Subnetting-Profi</span>
                </h2>
                <h3>
                    Meistere IP-Adressierung und Subnetzberechnung mit dem
                    interaktivenIP Trainer. Schluss mit der Verwirrung bei CIDR,
                    Netz-IDs und Broadcast-Adressen.
                </h3>
                <a class="button-link" href="#jetzt-herunterladen"
                    >Jetzt App holen</a
                >
            </section>
            <hr />
            <section>
                <div>
                    <h2>
                        <span class="purple-marker">Subnetting</span> muss nicht
                        kompliziert sein
                    </h2>
                    <img
                        class="tablet-img"
                        src="./images/app_tablet.png"
                        alt="Tablet with App running on screen"
                    />
                </div>
                <h3>
                    Die Berechnung von Subnetzen ist eine derkniffligsten, aber
                    wichtigsten Grundlagen der Netzwerktechnik. Das Lesen von
                    Theoriebüchernhilft nur bis zu einem gewissen Punkt. Hier
                    wirst du aktiv gefordert!
                </h3>
            </section>
            <hr />
            <section id="features">
                <h2><span class="purple-marker">Features</span></h2>
                <div class="carousel">
                    <div class="carousel-container">
                        <div class="carousel-slide active">
                            <h3>
                                ♾️ Übungsmodi mit unbegrenzten IPv4- und
                                IPv6-Aufgaben
                            </h3>
                            <img
                                class="no-resize"
                                src="./images/screenshot_feature1.png"
                                alt="App Feature 1"
                            />
                        </div>
                        <div class="carousel-slide">
                            <h3>
                                🔢 Eingabe zur automatischen IPv4 Berechnung
                            </h3>
                            <img
                                class="no-resize"
                                src="./images/screenshot_feature2.png"
                                alt="App Feature 2"
                            />
                        </div>
                        <div class="carousel-slide">
                            <h3>
                                ✅ Echtzeit-Validierung mit farblichem Feedback
                            </h3>
                            <img
                                class="no-resize"
                                src="./images/screenshot_feature3.png"
                                alt="App Feature 3"
                            />
                        </div>
                        <div class="carousel-slide">
                            <h3>
                                🎯 IHK-Must-Know Adresstypen mit Zusatzinfos
                            </h3>
                            <img
                                class="no-resize"
                                src="./images/screenshot_feature4.png"
                                alt="App Feature 4"
                            />
                        </div>
                        <div class="carousel-slide">
                            <h3>
                                📚 IP-Hinweise und Tabellen für schnelles Lernen
                                in der App
                            </h3>
                            <img
                                class="no-resize"
                                src="./images/screenshot_feature5.png"
                                alt="App Feature 5"
                            />
                        </div>
                        <div class="carousel-slide">
                            <h3>
                                📱 PWA - als native App installierbar und
                                offline nutzbar
                            </h3>
                            <img
                                class="no-resize"
                                src="./images/screenshot_feature6a.jpeg"
                                alt="App Feature 6"
                            />
                        </div>
                        <div class="carousel-slide">
                            <h3>
                                🌐 Zweisprachig: Fachbegriffe auf Deutsch und
                                Englisch lernen
                            </h3>
                            <img
                                class="no-resize"
                                src="./images/screenshot_feature7.png"
                                alt="App Feature 7"
                            />
                        </div>
                    </div>
                    <button class="carousel-btn prev">❮</button>
                    <button class="carousel-btn next">❯</button>
                    <div class="carousel-dots">
                        <span class="dot active">
                            <img
                                class="no-resize"
                                src="./images/gear-solid-full.svg"
                                alt="Gear 1"
                            />
                        </span>
                        <span class="dot">
                            <img
                                class="no-resize"
                                src="./images/gear-solid-full.svg"
                                alt="Gear 2"
                            />
                        </span>
                        <span class="dot">
                            <img
                                class="no-resize"
                                src="./images/gear-solid-full.svg"
                                alt="Gear 3"
                            />
                        </span>
                        <span class="dot">
                            <img
                                class="no-resize"
                                src="./images/gear-solid-full.svg"
                                alt="Gear 4"
                            />
                        </span>
                        <span class="dot">
                            <img
                                class="no-resize"
                                src="./images/gear-solid-full.svg"
                                alt="Gear 5"
                            />
                        </span>
                        <span class="dot">
                            <img
                                class="no-resize"
                                src="./images/gear-solid-full.svg"
                                alt="Gear 6"
                            />
                        </span>
                        <span class="dot">
                            <img
                                class="no-resize"
                                src="./images/gear-solid-full.svg"
                                alt="Gear 7"
                            />
                        </span>
                    </div>
                </div>
            </section>
            <hr />
            <section id="jetzt-herunterladen">
                <div>
                    <h2>
                        <span class="purple-marker">Starte jetzt</span> dein
                        Training
                    </h2>
                    <h3>
                        Hol dir den IP Trainer und meistere die IP-Adressierung.
                        Investiere in deine Fähigkeiten und sei auf jede
                        Netzwerk-Herausforderung vorbereitet
                    </h3>
                    <a
                        class="button-link"
                        href="https://marcelo-ruediger.github.io/ip_trainer/"
                        target="_blank"
                        >Jetzt Herunterladen</a
                    >
                </div>
                <img
                    src="./images/app_phone.png"
                    alt="Hand holding Phone with App running on screen"
                />
            </section>
            <hr />
            <section id="rezensionen">
                <h2>
                    <span class="purple-marker">Testemonials</span>
                </h2>

                <?php if ($success_message): ?>
                    <div class="success-message" style="color: green; padding: 10px; margin: 10px 0;">
                        ✅ <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>

                <?php if ($error_message): ?>
                    <div class="error-message" style="color: red; padding: 10px; margin: 10px 0;">
                        ❌ <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>

                <h3>
                    Wir freuen uns über Ihre Bewertung: Bitte geben Sie uns 5
                    Sterne, um unsere App zu verbessern.
                </h3>
                <form method="post" action="index.php">
                    <div class="star-rating">
                        <input
                            type="radio"
                            id="star5"
                            name="rating"
                            value="5"
                        />
                        <label for="star5"></label>
                         <input
                            type="radio"
                            id="star4"
                            name="rating"
                            value="4"
                        />
                        <label for="star4"></label>
                        <input
                            type="radio"
                            id="star3"
                            name="rating"
                            value="3"
                        />
                        <label for="star3"></label>
                        <input
                            type="radio"
                            id="star2"
                            name="rating"
                            value="2"
                        />
                        <label for="star2"></label>
                        <input
                            type="radio"
                            id="star1"
                            name="rating"
                            value="1"
                        />
                        <label for="star1"></label>
                        <textarea
                            name="comment"
                            placeholder="Hinterlasse uns eine Nachricht (optional)..."
                        ></textarea>
                        <button type="submit">Jetzt bewerten</button>
                    </div>
                </form>
            </section>
        </main>
        <footer>
            <a href="#top-section">
                <img
                    src="./images/ip_icon_138457.png"
                    alt="IP icon"
                    class="hover-effect ip-icon-bottom"
                />
            </a>
            <a
                href="https://github.com/marcelo-ruediger/ip_trainer/issues/new"
                target="_blank"
            >
                <img
                    src="./images/envelope-solid-full.svg"
                    alt="Envelope Icon for contact"
                    class="hover-effect envelope-icon"
                />
            </a>
            <a
                href="https://github.com/marcelo-ruediger/ip_trainer"
                target="_blank"
            >
                <img
                    src="./images/square-github-brands-solid-full.svg"
                    alt="Github Icon"
                    class="hover-effect github-icon"
                />
            </a>
        </footer>
        <script src="./js/carousel.js"></script>
    </body>
</html>
