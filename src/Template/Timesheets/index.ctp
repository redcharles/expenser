<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Timesheets</li>
    </ol>
</nav>
<div class="row">
    <div class="col-6 text-left">
        <p class="lead">
            View Timesheets
        </p>
    </div>
    <div class="col-6 text-right">
        <a href="/timesheets/new">Add New</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <?= $this->Form->create() ?>
        <div class="form-group">
            <label for="selectDate">Select a Date</label>
            <input class="form-control" type="date" name="for_date">
        </div>
        <button class="form-control btn btn-success">Show Timesheet</button>
        <?= $this->Form->end() ?>
    </div>
</div>

<?php if($timesheet !== NULL): ?>
<table class="table mt-2 border">
    <thead>
        <tr>
            <th scope="col">Employee ID (Internal) </th>
            <th scope="col">Employee Name</th>
            <th scope="col">Job Number </th>
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednedsay</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
            <th scope="col">Saturday</th>
            <th scope="col">Sunday</th>
            <th scope="col">Days Worked</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($timesheet as $sheet): ?> 
        <tr>
            <th scope="row"><?= $sheet->employee_id ?></th>
            <td><?= $sheet->first_name . ' ' . $sheet->last_name ?></td>
            <td><?= $sheet->job_number ?></td>
            <td><?= $sheet->monday ?></td>
            <td><?= $sheet->tuesday ?></td>
            <td><?= $sheet->wednesday ?></td>
            <td><?= $sheet->thursday ?></td>
            <td><?= $sheet->friday ?></td>
            <td><?= $sheet->saturday ?></td>
            <td><?= $sheet->sunday ?></td>
            <td><?= $sheet->monday + $sheet->tuesday + $sheet->wednesday + $sheet->thursday + $sheet->friday + $sheet->saturday + $sheet->sunday ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
