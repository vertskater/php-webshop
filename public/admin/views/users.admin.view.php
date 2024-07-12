<?php use Cm\Shop\Helper\Renderer; ?>
<main class="container container-padding full-height">
    <section class="grid custom-grid">
    <aside class="side-menu">
        <ul>
            <?php foreach($roles as $role) :?>
                <li><a href="/admin/users.admin.php?role_id=<?=$role['id'] ?>" class="<?php echo $role_id == $role['id'] ? 'selected' : '' ?>"><?= ucfirst(Renderer::e($role['name'])) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </aside>
    <div>
        <table class="striped cart-price">
            <thead>
            <tr>
                <th><span class="material-icons">delete_outlined</span></th>
                <th>Name</th>
                <th>email (username)</th>
                <th>Birthdate</th>
                <th>Role</th>
                <th>Profile Image</th>
            </tr>
            </thead>
                    <?php foreach($users as $user) : ?>
              <tr>
                  <td><a href="delete-user.php?user_id=<?= Renderer::e($user['id']); ?>" class="delete-product">X</a> </td>
                  <td><?= Renderer::e($user['name'])?></td>
                  <td><?= Renderer::e($user['email'])?></td>
                  <td><?= Renderer::formatDate(Renderer::e($user['birthdate']))?></td>
                  <td><?php //Renderer::e($user['role']) ?>
                      <form action="change-role.admin.php?user_id=<?= Renderer::e($user['id']) ?>" method="post">
                          <label for="user-role">
                              <select class="role-option" name="user-role" id="user-role" onchange="this.form.submit()">
                                  <?php foreach ( $roles as $role ) : ?>
                                      <option  value="<?= $role['id'] ?>" <?php echo $role['name'] === $user['role'] ? 'selected' : '' ?>><?= Renderer::e($role['name']) ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </label>
                      </form>
                  </td>
                  <td class="user-img"><img src="/img/<?= Renderer::e($user['filename'])?>" alt="<?=Renderer::e($user['alt']) ?>"></td>
              </tr>
                    <?php endforeach; ?>
        </table>
        <div class="add-new">
            <a role="button" href="./new-user.php">Add new User</a>
        </div>
    </div>
    </section>
</main>