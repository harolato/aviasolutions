<?php
$sort_col = $this->Paginator->config('options.url.sort');
$sort_dir = $this->Paginator->config('options.url.direction');

?>
<div class="actions col-lg-2 col-md-2 col-sm-2 col-xs-2">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li>
            <button data-toggle="modal" data-target="#ajaxModal" data-type="form" data-title="Add Company" data-ajaxUrl="<?= $this->Url->build(['action' => 'add'])?>" type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-briefcase"> </span> <?= __("Add Company");?>
            </button>
        </li>
    </ul>
</div>
<div class="app-body companies index col-lg-offset-2 col-lg-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-md-10 col-xs-10 col-xs-offset-2">
    <h3><?= h(__("List of companies"))?></h3>
    <div style="margin-bottom: 20px;">
        <?= __("Sort by:");?>
        <div class="btn-group">
            <button type="button" class="btn btn-<?= ($sort_col == "name")?"warning":"default"?>">
                <?= $this->Paginator->sort('name', "Company name") ?>
                <span class="glyphicon glyphicon-sort-by-alphabet<?=($sort_dir == "desc" && $sort_col == "name")?"-alt":""?>"></span>
            </button>
            <button type="button" class="btn btn-<?= ($sort_col == "employee_count")?"warning":"default"?>">
                <?= $this->Paginator->sort('employee_count', "Number of employees");?>
                <span class="glyphicon glyphicon-sort-by-order<?=($sort_dir == "desc" && $sort_col == "employee_count")?"-alt":""?>"></span>
            </button>
        </div>
    </div>
    <?php foreach ($companies as $company): ?>
        <div class="btn-group company">
            <div class="btn-default btn company">
                <a class="company" href="<?= $this->Url->build(['action' => 'view', $company->id]);?>"> <?= __(h($company->name)) ?></a>
            </div>
            <?php if ($company->employee_count):?>
            <button type="button" class="btn btn-success company">
                    <span class="glyphicon glyphicon-user"> </span> <?= h(__($company->employee_count)); ?>
            </button>
            <?php endif;?>
            <button type="button" data-toggle="modal" data-target="#ajaxModal" data-type="confirm" data-title="Delete Company" data-message="Are you sure you want to delete following company: <?= h($company->name) ?>?" data-ajaxUrl="<?= $this->Url->build(['action' => 'delete', $company->id])?>" class="btn btn-danger company">
                <span class="glyphicon glyphicon-remove"> </span>
            </button>
        </div>
    <?php endforeach; ?>
    <br/>
    <?php if( $this->Paginator->numbers() ):?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
    <?php endif;?>
</div>
