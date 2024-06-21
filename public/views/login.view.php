<h1 class="login">Login</h1>
<main class="container login-container">
    <?php if(!empty($error)) : ?>
    <div class="error">
        <?= $error ?>
    </div>
    <?php endif; ?>
    <form action="../login.php" method="post">
        <label for="email" >E-Mail-Address
            <input type="email" id="email" name="email" value="<?= $email ?? '' ?>">
        </label>
        <label for="password">Password
            <input type="password" id="password" name="password">
        </label>
        <input type="submit" value="Login">
    </form>
</main>
