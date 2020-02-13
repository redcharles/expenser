<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/jobs">Jobs</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add New</li>
    </ol>
</nav>
<div class="row">
    <div class="col-12">
        <div class="shadow-lg card w-25 ml-auto mr-auto ">
            <div class="card-header">
                <p class="card-text text-center">
                    Create a New Job
                </p>
            </div>
            <div class="card-body">
                <?= $this->Form->create() ?>
                <div class="form-group">
                    <input type="text" class="form-control" name="job_number" placeholder="Job Number" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="job_name" placeholder="Job Name (optional)">
                </div>
                <div class="form-group">
                    <select name="state" id="" class="form-control">
                        <option value="" required>Select a State</option>
                        <?php foreach($states as $k => $v): ?>
                            <option value="<?= $k ?>"><?= $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" name="start_date">
                </div>
                <div class="form-group">
                    <input type="text" name="budget" class="form-control" placeholder="Budget (optional) ">
                </div>
                <button class="btn btn-primary w-100">Save Job</button>
                <?= $this->Flash->render() ?>
                <?= $this->Form->end() ?>
            </div>
        </div>

    </div>
</div>
