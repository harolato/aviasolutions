<?= $this->Form->create($employee) ?>
<?= $this->Form->input('name',[
    'class' => 'form-control',
    'placeholder' => "Name",
    'label' => "Name"
]);?>
<?= $this->Form->input('surname',[
    'class' => 'form-control',
    'placeholder' => "Surname",
    'label' => "Surname"
]);?>
<?= $this->Form->input('email',[
    'class' => 'form-control',
    'placeholder' => "Email address",
    'label' => "Email address"
]);?><label><?= __("Employment date")?></label>
<div class="input-group ">
    <?= $this->Form->day('employment_date',[
        'class' => 'input-group-addon',
        'style' => 'width:28%;',
        'empty' => 'Day'
    ]) ?>
    <?= $this->Form->month('employment_date',[
        'class' => 'input-group-addon',
        'style' => 'width:42%;',
        'empty' => 'Month'
    ]) ?>
    <?= $this->Form->year('employment_date',[
        'class' => 'input-group-addon',
        'style' => 'width:30%',
        'empty' => 'Year'
    ]) ?>
</div>
<?= $this->Form->input('company_id',[
    'options' => $companies,
    'class' => 'form-control'
]); ?>
<?= $this->Form->end() ?>
