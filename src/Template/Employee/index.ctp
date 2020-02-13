<!-- View, Edit, or Add Employees -->

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Employee's</li>
    </ol>
</nav>
<div class="row">
    <div class="col-6 text-left">
        <p class="lead">
            Manage Employee's 
        </p>        
    </div>
    <div class="col-6 text-right">
        <a href="/employee/add">Add New</a>
    </div>
    <div class="col-12">
        <ul class="list-group">
            <?php foreach($employees as $employee): ?>
            <li class="list-group-item">
               <a href="/employee/edit/<?= $employee->id ?>"> <?= $employee->first_name . ' ' . $employee->last_name ?> </a> <span class="badge badge-success">$<?= $employee->salary ?>/hour</span>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
