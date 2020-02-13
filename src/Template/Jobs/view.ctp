<?php 
global $daysWorked;
$daysWorked = 0;
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/jobs">Jobs</a></li>
        <li class="breadcrumb-item active" aria-current="page"><em><?= $jobNumber ?></em></li>
    </ol>
</nav>

<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header text-center">
                Days Worked
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Employee Name</th>
                            <th scope="col">Supervisor Name</th>
                            <th scope="col">Days Worked</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($jobTimesheet as $entry): ?>
                        <tr>
                            <td><?= $entry->first_name . ' ' . $entry->last_name ?></td>
                            <td><?= ucwords($entry->manager_first . ' ' . $entry->manager_last) ?></td>
                            <td><?= $entry->days_worked ?></td>
                            <?php $daysWorked = $daysWorked + $entry->days_worked;?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                Total Days Worked: <?= $daysWorked ?>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                Purchases
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Item Purchased</th>
                            <th scope="col">Item Cost</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Recorded By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($jobExpenses as $expense): ?>
                            <tr>
                                <td><?= $expense->item_name ?></td>
                                <td><?= $expense->item_cost ?></td>
                                <td><?= $expense->quantity ?></td>
                                <td><?= ucwords($expense->recorded_by_first . ' ' . $expense->recorded_by_last) ?></td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
