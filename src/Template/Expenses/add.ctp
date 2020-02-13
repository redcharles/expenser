<!-- Add New Expenses -->
<div class="row">
    <div class="col-md-12 text-center">
        <p class="lead">
            Add Inventory/Cost
        </p>
    </div>
    <div class="col-3">
        <?= $this->Form->create(null, [
            'id' => 'addExpense'
        ]) ?>
        <div class="form-group ml-1 mr-1">
            <select name="taxable" id="" class="form-control">
                <option value="1">Taxable</option>
                <option value="0">Non-Taxable</option>
            </select>
        </div>
        <div class="form-group ml-1 mr-1">
            <input type="text" class="form-control" placeholder="Item Name" name="item_name" required>
        </div>
        <div class="form-group ml-1 mr-1">
            <select class="form-control" name="job_number">
                <option value="#" required>Select Job Number</option>
                <?php foreach($jobs as $job): ?>
                    <option value="<?= $job->number ?>"><?= $job->number ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group ml-1 mr-1">
            <select class="form-control" name="purchase_state">
                <?php foreach($states as $k => $v): ?>
                <option value="<?= $k ?>"><?= $v ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group ml-1 mr-1">
            <select class="form-control" name="cat_name">
                <option value="">Select Category</option>
                <?php foreach($categories as $category): ?>
                <option value="<?= $category->cat_name ?>"><?= $category->cat_name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group ml-1 mr-1">
            <input type="text" class="form-control" placeholder="Item Cost" name="item_cost" required>
        </div>
        <div class="form-group ml-1 mr-1">
            <input type="text" class="form-control" placeholder="Quantity" name="quantity" required>
        </div>
        <div class="form-group ml-1 mr-1">
            <input type="date" class="form-control" name="item_date" required>
        </div>
        <div class="form-group ml-1 mr-1">
            <button class="btn btn-primary">
                Add Expense
            </button>
        </div>
        <?= $this->Form->end() ?>
    </div>
    <?php 
    /**
     * This table is generated initially by PHP, but is built onto by JavaScript on the front end - dashboard.js is the corresponding file.
     */
    ?>
    <div class="col-9">
        <table class="table mt-2 addExpenseTable <?= ($prevExpenses->count() > 0 ? "show" : 'hide') ?>">
            <thead>
                <tr>
                    <th scope="col">Taxable</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Number</th>
                    <th scope="col">Item Cost</th>
                    <th scope="col">State of Purchase</th>
                    <th scope="col">Item Category</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Date Added</th>
                    <!-- <th scope="col">Remove</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach($prevExpenses as $expense): ?>
                <tr data-id="<?= $expense->id ?>">
                    <td><?= $expense->taxable ?></td>
                    <td><?= $expense->item_name ?></td>
                    <td><?= $expense->item_number ?></td>
                    <td><?= $expense->item_cost?></td>
                    <td><?= $expense->purchase_state ?></td>
                    <td><?= $expense->cat_name ?></td>
                    <td><?= $expense->quantity ?></td>
                    <td><?= date_format($expense->item_date, 'Y-m-d') ?></td>
                    <!-- <td class='deleteRow'>X</td> -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
