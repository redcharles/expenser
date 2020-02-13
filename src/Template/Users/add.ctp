<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="col-2">
        <ul>
            <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        </ul>
    </div>

    <div class="col-8"> 
        <p class="lead">
            Create a New User
        </p>
        <?= $this->Flash->render() ?>
        <?= $this->Form->create($user) ?>
        <div class="form-group">
            <label for="first_name">Set User's First Name</label>
            <input class="form-control" type="first_name" type="text" name="first_name" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="first_name">Set User's Last Name</label>
            <input class="form-control" type="first_name" type="text" name="last_name" placeholder="First Name">
        </div>
        <div class="form-group">
            <label for="email">Set User Email</label>
            <input id="email" class="form-control" type="text" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Set User Password</label>
            <input id="password" class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="selectRole">Select User Role</label>
            <select class="form-control" name="role" id="selectRole">
                <option value="" required>Select a role...</option>
                <option value="0">Administrator</option>
                <option value="1">Operations Manager</option>
                <option value="2">General Superintendent</option>
                <option value="3">Super Intendent</option>
            </select>
        </div>
        <button class="btn btn-danger w-100">Create User</button>
        <?= $this->Form->end() ?>
    </div>
</div>

