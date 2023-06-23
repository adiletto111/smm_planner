<?php

namespace App\View\Users;

class Form extends \App\View\Main
{
    public function content(array $data)
    {
        ?>

            <div class="row">
                <div class="col lg-6">
                <div class="block-content block-content-full">
                    <form action="/users/add" method="POST">
                        <div class="row">
                            <div class="col-lg-8 col-xl-5">
                                <div class="form-floating mb-4 <?= isset($data['messages']['email']) ? 'has-error' : '' ?>">
                                    <label for="example-email-input-floating">Email пользователя</label>
                                    <input type="email" class="form-control" id="example-email-input-floating" name="email" placeholder="Введите Email" value="<?= $data['data']['email'] ?? '' ?>">
                                    <?php if (isset($data['messages']['email'])): ?>
                                        <div class="help-block"></div><?= $data['messages']['email'] ?>
                                    <?php endif ?>    
                                </div>
                                <div class="form-floating mb-4 <?= isset($data['messages']['password']) ? 'has-error' : '' ?>">
                                    <label for="example-password-input-floating">Пороль</label>
                                    <input type="password" class="form-control" id="example-password-input-floating" name="password" placeholder="Введите пороль">
                                    <?php if (isset($data['messages']['password'])): ?>
                                        <div class="help-block"></div><?= $data['messages']['password'] ?>
                                    <?php endif ?>
                                </div>
                                <div class="form-floating mb-4 <?= isset($data['messages']['confirm-password']) ? 'has-error' : '' ?>">
                                    <label for="example-password-input-floating">Повтор пороля</label>
                                    <input type="password" class="form-control" id="example-password-input-floating" name="confirm-password" placeholder="Повторите пороль">
                                    <?php if (isset($data['messages']['confirm-password'])): ?>
                                        <div class="help-block"></div><?= $data['messages']['confirm-password'] ?>
                                    <?php endif ?>
                                </div>
                                <div class="form-floating mb-4 <?= isset($data['messages']['name']) ? 'has-error' : '' ?>">
                                    <label for="example-text-input-floating">Имя</label>
                                    <input type="text" class="form-control" id="example-text-input-floating" name="name" placeholder="Введите имя" value="<?= $data['data']['name'] ?? '' ?>">
                                    <?php if (isset($data['messages']['name'])): ?>
                                        <div class="help-block"></div><?= $data['messages']['name'] ?>
                                    <?php endif ?>
                                </div>
                                <label for="material-select">Привилегия</label>
                                <select class="form-select" id="example-select-floating" name="privilege" aria-label="Floating label select example" <?= isset($data['messages']['privilege ']) ? 'has-error' : '' ?>>
                                    <option value="0">Менеджер</option>
                                    <option value="1">Администратор</option>
                                </select>
                            </div>
                        </div>
                        <div class="vol-sm-9">
                            <button class="btn btn-sm btn-primary" type="submit">Создать</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>

        <?php
    }
}

?>