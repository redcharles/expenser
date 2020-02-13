<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Jobs</li>
    </ol>
</nav>
<?= $this->Flash->render() ?>
<div class="row">
    <div class="col-12">
        <div class="card text-center">
            <div class="card-header">
                Current Jobs | <a href="/jobs/new">Add New</a>
            </div>
            <div class="card-body">
                <div class="row">
                <?php foreach($jobs as $job): ?>
                    <div class="col-2">
                        <div class="card border border-danger">
                            <div class="card-header">
                                <strong>
                                    Job Number: <?= $job->number ?>
                                </strong>
                            </div>
                            <div class="card-body text-left">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        Name: <span class="badge badge-danger"><?= $job->name ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        Start Date: <span class="badge badge-primary"><?= $job->start_date ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        Location: <span class="badge badge-success"><?= $job->location ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        Budget: <span class="badge badge-success">$<?= $job->budget ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <a style="color: white;" href="/jobs/view/<?= $job->number ?>" class="btn btn-primary form-control">
                                        View Expenses
                                    </a>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->create() ?>
                                    <input type="hidden" name="method" value="deleteJob">
                                    <input type="hidden" name="id" value="<?= $job->id ?>">
                                    <button class="btn btn-danger form-control">
                                        Delete Job
                                    </button>
                                    <?= $this->Form->end() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
