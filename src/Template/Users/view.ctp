<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="col-9">
        <div class="users view large-9 medium-8 columns content">
            <h3><?= h($user->email) ?></h3>
            <table class="table">
                <tr>
                    <th scope="row"><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Password') ?></th>
                    <td><?= h($user->password) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Role') ?></th>
                    <td><?= h($user->role) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Created') ?></th>
                    <td><?= h($user->created) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Modified') ?></th>
                    <td><?= h($user->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-3 text-center">
        <div class="col">
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id, 'class' => 'nav-link']) ?>
        </div>
        <div class="col">
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id, 'class' => 'nav-link'], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
        </div>
        <div class="col">
            <?= $this->Html->link(__('List Users'), ['action' => 'index', 'class' => 'nav-link']) ?>
        </div>
        <div class="col">
            <?= $this->Html->link(__('New User'), ['action' => 'add', 'class' => 'nav-link']) ?>
        </div>
    </div>

</div>
