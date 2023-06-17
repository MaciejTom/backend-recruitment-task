<div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
        <thead>
            <tr>
                <?php foreach ($params['userTableHeaders'] ?? [] as $userTableHeader) : ?>
                    <th><?php echo $userTableHeader ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
    </table>
</div>
<div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
        <tbody>
            <tr>
                <?php foreach (($param['usersArray'] ?? []) as $user) : ?>
                    <td>Name: <?php echo $user['name'] ?></td>
                    <td>UserName: <?php echo $user['username'] ?></td>
                    <td>Email: <?php echo $user['email'] ?></td>
                    <?php if (is_array($user['address'])) : ?>
                        <td>
                            <?php foreach (array_slice($user['address'], 0, 3) as $address) : ?>
                                <?php echo $address ?>
                            <?php endforeach ?>
                        </td>
                    <?php else : ?>
                        <td>Address: <?php echo $user['address'] ?></td>
                    <?php endif ?>
                    <td> <?php echo $user['phone'] ?></td>
                    <?php if (is_array($user['company'])) : ?>
                        <td><?php echo  $user['company']['name'] ?></td>

                    <?php else : ?>
                        <td><?php echo  $user['company'] ?></td>

                    <?php endif ?>
                    <td>
                        <form method="POST" action="/?action=delete">
                            <input name="id" type="hidden" value="<?php echo $user['id'] ?>" />
                            <input type="submit" value="Remove Button" />
                        </form>
                        </a>

                    </td>

            </tr>

        <?php endforeach ?>


        </tbody>
    </table>
</div>

<form action="/?action=form" method="POST">
    <ul>
        <li>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </li>

        <li>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </li>

        <li>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
        </li>

        <li>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address">
        </li>

        <li>
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone">
        </li>

        <li>
            <label for="company">Company:</label>
            <input type="text" id="company" name="company">
        </li>

        <li>
            <input type="submit" value="Submit">
        </li>
    </ul>
</form>