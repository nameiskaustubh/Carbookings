

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Listings</title>
    <?php require 'head.php'; ?>
    <style>
        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }

        /* Fade-in animation */
        .card {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }

        .card.show {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hover effect */
        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Blur and dim effect */
        .card.blur {
            filter: blur(5px) brightness(0.7);
            pointer-events: none;
        }

        /* Additional styling for smooth transition */
        .card-container {
            transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
        }
    </style>
</head>
<body p-5>
    <section class="" style="background-image: url('proimages/bg.jpg'); background-repeat: no-repeat; background-size: cover;">
        <?php require 'menu.php'; ?>
        <br><br><br>
        <div id="" style="text-align:center; padding:50px 80px; text-align: justify;">
            <div class="row">
                <?php
                $q = mysqli_query($con, "SELECT * FROM tblcar");
                while ($r = mysqli_fetch_array($q)) {
                    ?>
                    <div class="col-md-4">
                        <div class="card-container">
                            <div class="card rounded-5 shadow-5-strong">
                                <img src="admin/<?php echo $r['cimg']; ?>" class="card-img-top" style="padding: 10px 10px 10px 10px;" alt="Car Image"/>
                                <div class="card-body">
                                    <center>
                                        <h5 class="card-title"><?php echo $r["cname"]; ?></h5>
                                        <p class="card-text">
                                            <table class="table">
                                                <tr>
                                                    <td>Car Price</td>
                                                    <td>₹<?php echo $r['cprice']; ?>/-</td>
                                                </tr>
                                                <tr>
                                                    <td>Car Discount Price</td>
                                                    <td>₹<?php echo $r['cdprice']; ?>/-</td>
                                                </tr>
                                            </table>
                                        </p>
                                        <a href="viewdetails.php?id=<?php echo $r['cid']; ?>" class="btn btn-primary">View Details</a>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <br><br>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php require 'footer.php'; ?>
    </section>
    <script>
        // Script to add 'show' class to cards for fade-in effect
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                setTimeout(() => {
                    card.classList.add('show');
                }, 100);
            });

            // Add click event listener to each card
            cards.forEach(card => {
                card.addEventListener('click', function () {
                    cards.forEach(c => {
                        if (c !== card) {
                            c.classList.add('blur');
                        }
                    });
                    card.classList.remove('blur');
                });
            });

            // Remove blur when clicking outside any card
            document.addEventListener('click', function (e) {
                if (!e.target.closest('.card')) {
                    cards.forEach(c => c.classList.remove('blur'));
                }
            });
        });
    </script>
</body>
</html>
