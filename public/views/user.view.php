<main class="container container-padding">
    <h1>Welcome, <?= $user['username'] ?></h1>
    <section class="grid">
        <section>
            <table>
                <tbody>
                    <tr>
                        <td>
                            Name:
                        </td>
                        <td>
                            <?= $user['username']?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            E-Mail-Address:
                        </td>
                        <td>
			                    <?= $user['email']?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Shop-Role:
                        </td>
                        <td>
                            <?= $user['role']?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section class="profile-pic">
            <img src="<?=  './img/' . $user['image_name'] ?>" alt="<?= $user['image_alt'] ?>">
            <form action="/profile.php">
                <label for="image">Change Profile Pic</label>
                <input type="file" id="image" name="image">
            </form>
        </section>
    </section>
</main>