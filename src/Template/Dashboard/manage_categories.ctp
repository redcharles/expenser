<div class="row">
    <div class="col-sm-12 col-lg-3">
        <div class="card">
            <div class="card-header text-center">
                Create New Category
            </div>
            <div class="card-body">
                <?= $this->Form->create() ?>
                    <input type="hidden" name="method" value="addCat">
                    <div class="form-group">
                        <input class="form-control" type="text" name="category_name" placeholder="Enter category...">
                    </div>
                    <button class="btn btn-primary w-100">Save</button>
                    <?= $this->Flash->render() ?>
                <?= $this->Form->end()?>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-9">
        <div class="card">
            <div class="card-header text-center">
                Available Categories
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <td>
                                <strong>
                                    Category Name
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    Action
                                </strong>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $category): ?>
                            <tr>
                                <td>
                                    <?= $category->cat_name ?>
                                </td>
                                <td>
                                    <?= $this->Form->create() ?>
                                        <input type="hidden" name="method" value="deleteCat">
                                        <input type="hidden" name="id" value="<?= $category->id ?>">
                                        <button class="btn btn-danger">
                                            Delete
                                        </button>
                                    <?= $this->Form->end() ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>