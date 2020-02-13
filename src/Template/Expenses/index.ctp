<div class="row">
    <div class="col-12">
        <?= $this->Flash->render() ?>
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <?= $this->Form->create() ?>
                    <div class="form-group row">
                        <label for="from-date" class="col-1 col-form-label">From</label>
                        <div class="col-4">
                            <input class="form-control" type="date" name="from-date" value="2020-01-01" id="from-date">
                        </div>
                        <label for="to-date" class="col-1 col-form-label">To</label>
                        <div class="col-4">
                            <input class="form-control" type="date" name="to-date" value="2020-01-08" id="to-date">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-success">
                                Sort 
                            </button>
                        </div>
                    </div>
                <?= $this->Form->end() ?>
            </div>
            <div class="col-sm-12 col-lg-6">
                <a href="/expenses/add" class="btn btn-primary float-right mb-3">Add Expenses</a>
            </div>
        </div>
        
        <table class="table mt-2 ">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('job_number')?></th>
                    <th scope="col"><?= $this->Paginator->sort('taxable') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('item_name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('item_cost') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('purchase_state') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('cat_name') ?></th>
                    <th scope="col">Total Cost</th>
                    <th scope="col"><?= $this->Paginator->sort('item_date', ['value' => 'Date Added']) ?></th>
                    <th scope="col">Manage</th>
                    <!-- <th scope="col">Remove</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expenses as $expense) : ?>
                    <?= $this->Form->create() ?>
                    <input type="hidden" name="method" value="deleteRecord">
                    <tr>
                        <td><?= $expense->job_number ?></td>
                        <td><?= $expense->taxable ?></td>
                        <td><?= $expense->item_name ?></td>
                        <td>$<?= $expense->item_cost ?></td>
                        <td><?= $expense->quantity ?></td>
                        <td><?= $expense->purchase_state ?></td>
                        <td><?= $expense->cat_name ?></td>
                        <td>$<?= ($expense->item_cost * $expense->quantity) ?></td>
                        <td><?= date_format($expense->item_date, 'Y-m-d') ?></td>
                        <td>
                            <input type="hidden" name="id" value="<?= $expense->id ?>">
                            <button name="delete" class="btn btn-danger">Delete</button>
                        </td>
                        <!-- <td class='deleteRow'>X</td> -->
                    </tr>
                    <?= $this->Form->end() ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="col-12 text-center">
            <ul class="pagination justify-content-center">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>

    </div>
</div>