<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Management</title>
    <?php require 'head.php'; ?>
</head>
<body>

<?php require 'menu.php'; ?>
<section class="" style="background-image: url('proimages/bg.jpg'); background-repeat: no-repeat; background-size: cover;">
    <br><br><br><br><br><br><br><br><br>
    <div class="row">
        <?php
        // Fetch count of pending services for the user
        $q = mysqli_query($con, "SELECT COUNT(*) AS totaluser FROM tblservices WHERE status='0' AND uid=" . $_SESSION['uid']);
        $r = mysqli_fetch_array($q);

        if ($r['totaluser'] > 0) {
            // Fetch details of pending services
            $q = mysqli_query($con, "SELECT * FROM tblservices WHERE status='0' AND uid=" . $_SESSION['uid']);
            $ftotal = 0;

            while ($r = mysqli_fetch_array($q)) {
                if (isset($_POST['btnpays'])) {
                    // Update service status to 'paid'
                    mysqli_query($con, "UPDATE tblservices SET status='1' WHERE uid=" . $_SESSION['uid']);
                    header("Location: servicesuccess.php");
                }
                ?>
                <div class="col-md-2"></div>
                <div class="card col-md-8">
                    <center>
                        <div class="card-body">
                            <h5 class="card-title">YOUR SERVICES</h5>
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                <tr>
                                    <th width="15%">SERVICE ID</th>
                                    <th width="20%">SERVICE NAME</th>
                                    <th width="15%">DESCRIPTION</th>
                                    <th width="20%">CAR NUMBER PLATE</th>
                                    <th width="10%">SERVICE PRICE</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?php echo $r["sid"]; ?></td>
                                    <td><?php echo $r["sname"]; ?></td>
                                    <td><?php echo $r["sdesc"]; ?></td>
                                    <td><?php echo $r["cnp"]; ?></td>
                                    <td>₹<?php echo $r['sprice']; ?>/-</td>
                                </tr>
                                <?php
                                $total = $r["sprice"];
                                $ftotal += $total;
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4">Total:</td>
                                    <td>₹<?php echo $ftotal; ?>/-</td>
                                </tr>
                                </tfoot>
                            </table>
                            <form method="post">
                                <button type="submit" name="btnpays" class="btn btn-primary">PAY</button>
                            </form>
                        </div>
                    </center>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="col-md-2"></div>
            <div class="card col-md-8">
                <center>
                    <div class="card-body">
                        <h1 class="text-center">YOU DON'T HAVE ANY PENDING SERVICES</h1>
                    </div>
                </center>
            </div>
            <?php
        }
        ?>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <input type="button" onclick="window.print()" value="Print">
    <br>
    <?php require 'footer.php'; ?>
</section>
</body>
</html>
