<main class="container container-padding">
    <h1>Register new user</h1>
	<form class="register" action="../register.php" method="post">
		<label for="firstname">Firstname:
			<input type="text" id="firstname" name="firstname" placeholder="firstname" value="<?= $data['firstname'] ?? ''?>">
            <span class="error"><?= $errors['firstname'] ?? ''?></span>
		</label>
		<label for="lastname">Lastname:
			<input type="text" id="lastname" name="lastname" placeholder="lastname" value="<?= $data['lastname'] ?? ''?>">
            <span class="error"><?= $errors['lastname'] ?? ''?></span>
		</label>
		<label for="email">E-Mail-Address:
			<input type="email" id="email" name="email" placeholder="example@mail.at" value="<?= $data['email'] ?? ''?>">
            <span class="error"><?= $errors['email'] ?? ''?></span>
            <span class="error"><?= $errors['email_exists'] ?? ''?></span>
		</label>
		<label for="password">Password:
			<input type="password" id="password" name="password">
            <span class="error"><?= $errors['password'] ?? ''?></span>
		</label>
		<label for="password-confirm">Confirm Password:
			<input type="password" id="password-confirm" name="password-confirm">
            <span class="error"><?= $errors['password_match'] ?? ''?></span>
		</label>
        <input type="submit" value="Register">
	</form>
</main>