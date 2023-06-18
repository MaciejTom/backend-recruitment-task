<table class="table">
    <?php if (count($params['usersArray']) > 0) : ?>
        <thead>
            <tr class="table__row">
                <?php foreach ($params['tableHeaders'] ?? [] as $header) : ?>
                    <th class="table__header"><?php echo $header ?></th>
                <?php endforeach; ?>
                <th class="table__header"></th>
            </tr>
        </thead>
        <tbody>

            <?php foreach (($params['usersArray'] ?? []) as $user) : ?>
                <tr class="table__row">
                    <td class="table__data"><?php echo $user['name'] ?></td>
                    <td class="table__data"><?php echo $user['username'] ?></td>
                    <td class="table__data"><?php echo $user['email'] ?></td>
                    <?php if (is_array($user['address'])) : ?>
                        <td class="table__data">
                            <?php foreach (array_slice($user['address'], 0, 3) as $address) : ?>
                                <?php echo $address ?>
                            <?php endforeach ?>
                        </td>
                    <?php else : ?>
                        <td class="table__data"><?php echo $user['address'] ?></td>
                    <?php endif ?>
                    <td class="table__data"><?php echo $user['phone'] ?></td>
                    <?php if (is_array($user['company'])) : ?>
                        <td class="table__data"><?php echo  $user['company']['name'] ?></td>

                    <?php else : ?>
                        <td class="table__data"><?php echo  $user['company'] ?></td>

                    <?php endif ?>
                    <td class="table__data">
                        <form method="POST" action="/?action=delete">
                            <input name="id" type="hidden" value="<?php echo $user['id'] ?>" />
                            <input class="table__remove-button" type="submit" value="Remove" />
                        </form>
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    <?php else : ?>
        <div>There is no users :(</div>
    <?php endif ?>
</table>

<form class="form" action="/?action=form" method="POST">
    <ul class="form__list">
        <li class="form__item">
            <label class="form__label" for="name">Name:</label>
            <input class="form__input" type="text" id="name" name="name" required>
        </li>

        <li class="form__item">
            <label class="form__label" for="username">Username:</label>
            <input class="form__input" type="text" id="username" name="username" required>
        </li>

        <li class="form__item">
            <label class="form__label" for="email">Email:</label>
            <input class="form__input" type="email" id="email" name="email" required>
        </li>

        <li class="form__item">
            <label class="form__label" for="address">Address:</label>
            <input class="form__input" type="text" id="address" name="address" required>
        </li>

        <li class="form__item">
            <label class="form__label" for="phone">Phone:</label>
            <input class="form__input" type="tel" id="phone" name="phone" required>
        </li>

        <li class="form__item">
            <label class="form__label" for="company">Company:</label>
            <input class="form__input" type="text" id="company" name="company" required>
        </li>

        <li class="form__item">
            <input class="form__submit" type="submit" value="Submit">
        </li>
    </ul>
</form>