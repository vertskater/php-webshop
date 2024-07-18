<main class="container container-padding">
    <h1>Welcome, <?= strtoupper($user['username']) ?></h1>
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
                    <tr>
                        <td>
                            Date of Birth:
                        </td>
                        <td>
                            <?= date('d. M. Y' ,strtotime($user['birthdate']))?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
        <section class="profile-pic">
            <img src="<?=  './img/' . $user['image_name'] ?>" alt="<?= $user['image_alt'] ?>">
            <form action="/user.php?id=<?=$user['id'] ?>" method="post" enctype="multipart/form-data">
                <label for="image"></label>
                <input type="file" id="image" name="image" accept="image/jpeg, image/png">
                <span><?= $upload_errors['image'] ?? '' ?></span>
                <button type="submit">Change profile image</button>
            </form>
        </section>
    </section>
    <section>
        <h3>Purchase History:</h3>
        <hr/>
        <?php
        if(!empty($products)) {
            include ROOT_PATH . '/public/views/products-list.view.php';
        }
        ?>
    </section>
</main>