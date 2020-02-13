<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/employee">Employee's</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New</li>
    </ol>
</nav>

<div class="row">
    <div class="card ml-auto mr-auto">
        <?= $this->Flash->render() ?>
        <div class="card-header text-center">
            Add New Employee
        </div>
        <div class="card-body">
            <?= $this->Form->create() ?>
                <div class="form-group">
                    <label for="first_name">First Name </label>
                    <input type="text" class="form-control" name="first_name" id="first_name">
                </div>
                <div class="form-group">
                    <label for="first_name">Last Name </label>
                    <input type="text" class="form-control" name="last_name" id="first_name">
                </div>
                <div class="form-group">
                    <label for="first_name">Employee Id (Optional) </label>
                    <input type="text" class="form-control" name="employee_id" id="first_name">
                </div>
                <div class="form-group">
                    <label for="first_name">Hourly Pay (Optional) </label>
                    <input type="text" class="form-control" name="salary" id="first_name">
                </div>
                <div class="form-group">
                    <button class="form-control btn btn-primary">Save Employee</button>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>