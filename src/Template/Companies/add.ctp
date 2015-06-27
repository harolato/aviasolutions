<?= $this->Form->create($company) ?>
    <?= $this->Form->input('name',[
        'class' => 'form-control',
        'placeholder' => "Name of the company",
        'label' => "Name of the company"
    ]);?>
    <?= $this->Form->input('address',[
        'class' => 'form-control',
       'placeholder' => "Address",
        'label' => "Address"
    ]);?>
    <?= $this->Form->input('email',[
        'class' => 'form-control',
        'placeholder' => "Email address",
        'label' => "Email address"
    ]);?>
    <?= $this->Form->input('phone_no',[
        'class' => 'form-control',
        'placeholder' => "Phone number",
        'label' => "Phone number"
    ]);?>
<?= $this->Form->end() ?>
