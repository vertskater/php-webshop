<h1 class="login">Login</h1>
<main class="container login-container">
    <?php if(!empty($error)) : ?>
    <div class="error">
        <?= $error ?>
    </div>
    <?php endif; ?>
	<?php if(!empty($success)) : ?>
      <div class="success">
				<?= $success ?>
      </div>
	<?php endif; ?>
    <form action="../login.php" method="post">
        <label for="email" >E-Mail-Address
            <input type="email" id="email" name="email" value="<?= $email ?? '' ?>" autocomplete="username">
        </label>
        <label for="password">Password
            <input type="password" id="password" name="password" autocomplete="current-password">
        </label>
        <input type="submit" value="Login">
    </form>
    Not a Shop User? <a class="register-link" href="/register.php">Register a new User!</a>
</main>
