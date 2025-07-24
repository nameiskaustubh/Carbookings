<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Customer Signup</title>
	<?php require 'head.php'; ?>
	<style>
		/* General font settings */
		body {
			font-family: 'Arial', sans-serif;
			color: #333;
		}

		/* Fade-in animation */
		.form-control, .btn, textarea {
			opacity: 0;
			transform: translateY(20px);
			transition: opacity 0.5s ease-out, transform 0.5s ease-out;
		}

		.form-control.show, .btn.show, textarea.show {
			opacity: 1;
			transform: translateY(0);
		}

		/* Card styling */
		.table {
			animation: fadeIn 1s ease-in-out;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: translateY(20px);
			}
			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		/* Background image styling */
		.bg-image {
			position: relative;
			transition: opacity 1s ease-in-out;
		}

		/* Hover effect */
		.btn:hover {
			transform: scale(1.05);
			transition: transform 0.3s ease-in-out;
		}
	</style>
</head>
<body>
<section class="" style="background-image: url(proimages/rbackground.jpg); background-repeat: no-repeat;background-size: cover;">
<?php
if(isset($_POST['btnregister'])){
	extract($_POST);
	mysqli_query($con,"insert into tbluser(uname,upass,email,phone,address,gender)values('$txtname','$txtpass','$txtemail','$txtphone','$txtaddress','$rbgender')");
	header("location:signupsuccess.php");
}
?>
<?php require 'menu.php'; ?>
<br><br><br>
<div class="row">
	<div class="col-md-7"></div>
	<div class="col-md-4">
		<form method="post">
			<table class="table bg-white rounded-5 shadow-5-strong p-5">
				<tr>
					<td colspan=2 align=center>
						<h2>CUSTOMER SIGNUP</h2>
						<br>
					</td>
				</tr>
				<tr>
					<td>Name</td>
					<td>
						<input type="text" class="form-control" placeholder="Enter Letters Only" pattern="[a-zA-Z][a-zA-Z\s]*" name="txtname" required>
					</td>
				</tr>
				<tr>
					<td>Password</td>
					<td>
						<input type="password" class="form-control" placeholder="Enter Password" name="txtpass" required>
					</td>
				</tr>
				<tr>
					<td>Gender</td>
					<td>
						<input type="radio" checked name="rbgender" value="Male"> Male
						<input type="radio" name="rbgender" value="Female"> Female
					</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
						<input type="email" class="form-control" pattern="[a-z]+[0-9]*@[a-z]+[0-9]*\.[a-z]{2,3}" placeholder="Enter Valid Email Format" name="txtemail" required>
					</td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>
						<input type="text" class="form-control" pattern="[0-9]{10}" name="txtphone" placeholder="Enter Numbers Only" required>
					</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>
						<textarea name="txtaddress" class="form-control" placeholder="Enter Address" required></textarea>
					</td>
				</tr>
				<tr>
					<td colspan=2 align="center">
						<input type="submit" class="btn btn-dark" name="btnregister" value="Sign Up">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<br><br><br><br>
<?php require 'footer.php'; ?>
<script>
	// Fade-in effect for form elements
	document.addEventListener('DOMContentLoaded', function() {
		const formControls = document.querySelectorAll('.form-control, .btn, textarea');

		setTimeout(() => {
			formControls.forEach(element => {
				element.classList.add('show');
			});
		}, 100);
	});
</script>
</section>
</body>
</html>
