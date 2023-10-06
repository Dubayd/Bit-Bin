<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
    <title>Overview - Bitbin</title>
</head>

<body>
    <!-- includes -->
    <?php include "includes/navbar.php" ?>

    <?php
    include "includes/DBconnect.php";
    $stmt = $conn->prepare("SELECT * FROM pastes");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <!-- cards -->
    <div class="overview">
        <div class="pastes">
            <?php foreach ($result as $paste) :
                $expirationDateTime = new DateTime($paste['expiration']);
                $currentDateTime = new DateTime();
                if ($expirationDateTime > $currentDateTime) : ?>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="column no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Paste
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php echo htmlspecialchars(substr($paste['code'], 0, 60)); ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <?php echo $paste['category']; ?>
                                        <br><a href="view.php?id=<?php echo $paste['unique_id']; ?>" class="btn btn-primary">View Paste</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;
            endforeach; ?>
        </div>
    </div>
            <!-- footer include -->
    <?php include "includes/footer.php" ?>
</body>

</html>
