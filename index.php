<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.7.0/build/styles/default.min.css">
    <title>Bitbin</title>
</head>

<body>

    <!-- navbar include -->
    <?php include 'includes/navbar.php';
    ?>

    <div class="container">
        <div class="left-side">
            <form method="POST" action="save.php">
                <!-- paste area -->
                <div class="form-group">
                    <label for="codeArea">Paste it!</label>
                    <textarea class="form-control" id="codeArea" name="codeArea" rows="15" cols="50" required></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit your paste!">

        </div>

        <div class="right-side">
            <div class="pastesettings">
                <h6>Required paste settings</h6>
                <!-- Category form -->
                <div class="form-group">
                    <label for="categoryArea">Category:</label>
                    <select class="form-control" id="categoryArea" name="categoryArea" required>
                        <option value="">--select--</option>
                        <option value="Code">Code</option>
                    </select>
                </div>
                <!-- syntax highlights form -->
                <div class="form-group">
                    <label for="syntaxArea">Syntax highlighting:</label>
                    <select class="form-control" id="syntaxArea" name="syntaxArea">
                        <option value="">--select--</option>
                        <option value="HTML">HTML</option>
                        <option value="PHP">PHP</option>
                    </select>
                </div>
                <!-- paste expiration form -->
                <div class="form-group">
                    <label for="expirationArea">Paste expiration:</label>
                    <select class="form-control" id="expirationArea" name="expirationArea" required>
                        <option value="">--select--</option>
                        <option value="10 Minutes">10 Minutes</option>
                        <option value="1 Hour">1 Hour</option>
                        <option value="1 Day">1 Day</option>
                        <option value="1 Week">1 Week</option>
                        <option value="1 Month">1 Month</option>
                    </select>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- footer include -->
    <?php include 'includes/footer.php'; ?>

    <!-- connecting to database -->
    <?php
    include_once('includes/DBconnect.php');
    ?>

</body>

</html>