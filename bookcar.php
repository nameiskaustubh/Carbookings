

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Booking</title>
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

        /* Button hover effect */
        .btn:hover {
            transform: scale(1.1);
            transition: transform 0.2s ease-in-out;
        }

        /* Additional styling for smooth transition */
        .card-container {
            transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
        }
    </style>
</head>
<body>
    <?php require 'menu.php'; ?>
    <section class="" style="background-image: url('proimages/bg.jpg'); background-repeat: no-repeat; background-size: cover;">
        <br><br><br><br><br>
        <?php
        if(isset($_POST["btnbookcar"])){
            extract($_POST);
            mysqli_query($con,"insert into tblbookings(cid, clrid, mid, uid, status) values ('".$_GET["id"]."', '$color', '$model', '".$_SESSION['uid']."', '0')");
            header("location: confirmbooking.php");
        }
        ?>
        <center>
        <div class="row">
            <?php
            $q = mysqli_query($con, "select count(*) as totaluser from tblbookings where tblbookings.uid=".$_SESSION['uid']);
            $r = mysqli_fetch_array($q);
            if ($r['totaluser'] < 3) {
            ?>
            <?php
            $q = mysqli_query($con, "select * from tblcar where cid=".$_GET['id']);
            while ($r = mysqli_fetch_array($q)) {
            ?>
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card-container">
                    <div class="card">
                        <img src="admin/<?php echo $r['cimg']; ?>" class="card-img-top" alt="Car Image"/>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $r["cname"]; ?></h5>
                            <center>
                                <p class="card-text">
                                    <form method="post">
                                        <table class="table ">
                                            <tr>
                                                <td>Discount Price</td>
                                                <td><?php echo $r["cdprice"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Car Bookings Price</td>
                                                <td><?php echo $r["cbprice"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Expected Waiting Period</td>
                                                <td><?php echo $r["cwp"]; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Color</td>
                                                <td>
                                                    <select name="color" class="form-control">
                                                        <?php
                                                        $q = mysqli_query($con, "select * from tblcolor");
                                                        while ($color = mysqli_fetch_array($q)) {
                                                        ?>
                                                        <option value="<?php echo $color['clrid']; ?>"><?php echo $color["clrname"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Model</td>
                                                <td>
                                                    <select name="model" class="form-control">
                                                        <?php
                                                        $q = mysqli_query($con, "select * from tblmodel");
                                                        while ($model = mysqli_fetch_array($q)) {
                                                        ?>
                                                        <option value="<?php echo $model['mid']; ?>"><?php echo $model["mname"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="submit" name="btnbookcar" value="Book Car" class="btn btn-success">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </p>
                            </center>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
            <?php
            }
            } else {
            ?>
            <div class="col-md-2"></div>
            <div class="card col-md-8">
                <center>
                    <div class="card-body">
                        <h2></h2>
                        <h2 class="text-center">MAXIMUM BOOKINGS REACHED</h2>
                        <br><br>
                        <p class="text-center"><h8 class="">Note: Maximum 3 cars can be booked from an Account</h8></p>
                    </div>
                </center>
            </div>
            <?php
            }
            ?>
        </div>
        <br><br><br><br><br>
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
