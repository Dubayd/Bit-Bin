<?php
// Establish a database connection (replace with your database credentials) and GeSHi connection for syntax highlighting
include_once('includes/DBconnect.php');
include_once('GeSHi-1.0.9.0/geshi/geshi.php');

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the paste ID is provided in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Retrieve the paste from the database
        $stmt = $conn->prepare("SELECT * FROM pastes WHERE unique_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $paste = $stmt->fetch(PDO::FETCH_ASSOC);

        $syntax = $paste['syntax'];

        // check which language is being pasted 
        if ($syntax == "PHP") {
            $source = $paste['code'];
            $language = "php";

            $geshi = new GeSHi($source, $language);
        } elseif ($syntax == "HTML") {
            $source = $paste['code'];
            $language = "html5";

            $geshi = new GeSHi($source, $language);
        }

        // Check if a paste with the given ID exists
        if ($paste) {
            $code = $paste['code'];

            // Check if the paste has expired
            $expirationDateTime = $paste['expiration'];
            $currentDateTime = date('Y-m-d H:i:s');
            if ($expirationDateTime <= $currentDateTime) {
                // The paste has expired
                echo "This paste has expired.<br>";
                echo "Redirecting in 3 seconds";
                header("refresh:3;url=index.php");
                exit();
            }
        } else {
            // Handle the case when the paste does not exist
            echo "Paste not found.";
            exit();
        }
    } else {
        // Handle the case when no paste ID is provided
        echo "No paste ID provided.";
        exit();
    }



    // Function to generate the shareable link
    function generateShareLink($id)
    {
        $protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === 'on' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $link = $protocol . $host . $uri . '/view.php?id=' . $id;
        return $link;
    }

    // Check if the share button is clicked
    if (isset($_POST['share'])) {
        // Generate the shareable link
        $shareLink = generateShareLink($id);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the prepared statement and database connection
$stmt = null;
$conn = null;
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Bitbin</title>
</head>

<body>
    <!-- navbar include -->
    <?php include 'includes/navbar.php'; ?>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <form method="POST" action="view.php?id=<?php echo $id; ?>">
                    <div class="form-group">
                        <label for="codeArea">Copy it!</label><br><br>
                        <div class="viewarea">
                            <?php echo $geshi->parse_code(); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="copyToClipboard()" class="btn btn-primary">Share</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- footer include -->
    <?php include 'includes/footer.php'; ?>

    <script>
        function copyToClipboard() {
            var shareLink = window.location.href;
            navigator.clipboard.writeText(shareLink)
                .then(function() {
                    alert("URL copied to clipboard: " + shareLink);
                })
                .catch(function(error) {
                    alert("Failed to copy URL to clipboard: " + error);
                });
        }
    </script>
</body>

</html>