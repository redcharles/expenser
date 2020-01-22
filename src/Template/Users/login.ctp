<div class="row">
    <div class="col-12">
        <div class="card ml-auto mr-auto w-80">
            <div class="card-header">
                <h1>Sign In</h1>
            </div>
            <div class="card-body">
            <?=$this->Form->create()?>
            <?=$this->Form->control('email', [
                'class' => 'form-control my-2',
                'required' => true,
                'label' => false,
                'placeholder' => 'Email'
            ])?>
            <?=$this->Form->control('password', [
                'class' => 'form-control my-2',
                'required' => true,
                'label' => false,
                'placeholder' => 'Password'
            ])?>
            <?=$this->Form->button('Login', [
                'class' => 'btn btn-primary my-2 w-100'
            ])?>
            <?=$this->Form->end()?>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->