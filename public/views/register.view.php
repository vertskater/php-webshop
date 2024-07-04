<main class="container container-padding">
    <h1>Register new user</h1>
	<form class="register" action="../register.php" method="post">
        <div class="register-gender">
            <label for="male">Male:
                <input type="radio" id="male" name="gender" value="male">
            </label>
            <label for="female">Female:
                <input type="radio" id="female" name="gender" value="female">
            </label>
            <label for="binary">Binary:
                <input type="radio" id="binary" name="gender" value="binary">
            </label>
            <span class="error"><?= $errors['gender'] ?? ''?></span>
        </div>
		<label for="firstname">Firstname:
			<input type="text" id="firstname" name="firstname" placeholder="firstname" value="<?= $data['firstname'] ?? ''?>">
            <span class="error"><?= $errors['firstname'] ?? ''?></span>
		</label>
		<label for="lastname">Lastname:
			<input type="text" id="lastname" name="lastname" placeholder="lastname" value="<?= $data['lastname'] ?? ''?>">
            <span class="error"><?= $errors['lastname'] ?? ''?></span>
		</label>
        <label for="lastname">Date of birth:
            <input type="date" id="birthdate" name="birthdate" value="<?= $data['birthdate'] ?? ''?>">
            <span class="error"><?= $errors['birthdate'] ?? ''?></span>
        </label>
		<label for="email">E-Mail-Address:
			<input type="email" id="email" name="email" placeholder="example@mail.at" value="<?= $data['email'] ?? ''?>" autocomplete="username">
            <span class="error"><?= $errors['email'] ?? ''?></span>
            <span class="error"><?= $errors['email_exists'] ?? ''?></span>
		</label>
		<label for="password">Password:
			<input type="password" id="password" name="password" autocomplete="new-password">
            <span class="error"><?= $errors['password'] ?? ''?></span>
		</label>
		<label for="password-confirm">Confirm Password:
			<input type="password" id="password-confirm" name="password-confirm" autocomplete="new-password">
            <span class="error"><?= $errors['password_match'] ?? ''?></span>
		</label>
        <input type="submit" value="Register">
	</form>
</main>