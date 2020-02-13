<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/timesheets">Timesheets</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New</li>
    </ol>
</nav>

<!-- Job Number, Employee ID, Associated ID, Mon-Sun (T/F), For Week Of (Date) -->

<div class="row">
    <div class="col-12">
        <p class="lead">
            Create a New Timesheet Entry
        </p>
    </div>
</div>

<?= $this->Flash->render() ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <?= $this->Form->create() ?>
            <div class="card-header">
                Employee
            </div>
            <div class="card-body">
                <div class="form-group">
                    <select class="form-control" name="job_number" id="">
                        <option value="" required>Select Job Number</option>
                        <?php foreach($jobs as $job): ?>
                        <option value="<?= $job->number ?>"><?= $job->number ?></option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="employee_id" id="">
                        <option value="" required>Select Employee</option>
                        <?php foreach($employees as $employee): ?>
                        <option value="<?= $employee->id ?>"><?= $employee->first_name . ' ' . $employee->last_name?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input name="monday" class="form-check-input" type="checkbox" id="monday" value="1">
                        <label class="form-check-label" for="monday">Monday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="tuesday" class="form-check-input" type="checkbox" id="tuesday" value="1">
                        <label class="form-check-label" for="tuesday">Tuesday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="wednesday" class="form-check-input" type="checkbox" id="wednesday" value="1">
                        <label class="form-check-label" for="wednesday">Wednesday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="thursday" class="form-check-input" type="checkbox" id="thursday" value="1">
                        <label class="form-check-label" for="thursday">Thursday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="friday" class="form-check-input" type="checkbox" id="friday" value="1">
                        <label class="form-check-label" for="friday">Friday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="saturday" class="form-check-input" type="checkbox" id="saturday" value="1">
                        <label class="form-check-label" for="saturday">Saturday</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="sunday" class="form-check-input" type="checkbox" id="sunday" value="1">
                        <label class="form-check-label" for="sunday">Sunday</label>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" name="for_week" >
                </div>
                <div class="form-group">

                </div>
            </div>
            <div class="card-footer">
                <button class="form-control btn btn-success">
                    Save
                </button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
