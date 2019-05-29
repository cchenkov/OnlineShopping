<?php include "templates/header.php"; ?>

<h1>Add a user</h1>
<form method="post">
  <label for="username">Username</label>
  <input type="text" name="username" id="username">
  <br>
  <label for="firstname">First Name</label>
  <input type="text" name="firstname" id="firstname">
  <br>
  <label for="lastname">Last Name</label>
  <input type="text" name="lastname" id="lastname">
  <br>
  <label for="email">Email Address</label>
  <input type="text" name="email" id="email">
  <br>
  <label for="password">Password</label>
  <input type="password" name="password" id="pass">
  <br>
  <label for="address">Address</label>
  <input type="text" name="address" id="address">
  <br>
  <label for="number">Phone Number</label>
  <input type="text" name="number" id="number">
  <br>
  <br>
  <input type="submit" name="submit" value="Submit">
</form>

<br>
<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>