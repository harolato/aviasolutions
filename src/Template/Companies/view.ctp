<div class="actions col-lg-2 col-md-2 col-sm-2 col-xs-2">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li>
            <button data-toggle="modal" data-target="#ajaxModal" data-type="form" data-title="Edit Company" data-ajaxUrl="<?= $this->Url->build(['action' => 'edit', $company->id])?>" type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-pencil"> </span> Edit Company
            </button>
        </li>
        <li>
            <button data-toggle="modal" data-target="#ajaxModal" data-type="form" data-title="Add new Employee to company <?= h(__($company->name))?>" data-ajaxUrl="<?= $this->Url->build(['controller' => 'Employees', 'action' => 'add', $company->id])?>" type="button" class="btn btn-default">
                <span class="glyphicon glyphicon-user"> </span> Add Employee
            </button>
        </li>
        <li>
            <button data-toggle="modal" data-target="#ajaxModal" data-type="confirm" data-noAjax="true" data-title="Delete Company" data-message="Are you sure you want to delete following company: <?= h($company->name) ?>?" data-ajaxUrl="<?= $this->Url->build(['action' => 'delete', $company->id])?>" type="button" class="btn btn-danger">
                <span class="glyphicon glyphicon-minus"> </span> Delete Company
            </button>
        </li>
    </ul>
</div>
<div class="app-body companies view col-lg-offset-2 col-lg-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-md-10 col-xs-10 col-xs-offset-2">
    <br/>
    <a href="<?= $this->Url->build(['action' => 'index'])?>">
        <button title="Go back" type="button" class="btn btn-primary">
            <span class="glyphicon glyphicon-menu-left"></span>
        </button>
    </a>
    <h2><?= h($company->name) ?></h2>
    <div class="row">
        <table class="table table-hover">
            <tr>
                <td><span class="glyphicon glyphicon-home"> </span> <?= __(' Address') ?></td>
                <td><?= h($company->address) ?></td>
            </tr>
            <tr>
                <td><span class="glyphicon glyphicon-envelope"> </span> <?= __(' Email address') ?></td>
                <td><?= h($company->email) ?></td>
            </tr>
            <tr>
                <td><span class="glyphicon glyphicon-phone"> </span> <?= __(' Phone number') ?></td>
                <td><?= h($company->phone_no) ?></td>
            </tr>
        </table>
    </div>
    <?php if (!empty($employees)):?>
    <h2 class="employees"><?= h("Employees(" . count($employees) . ")") ?></h2>
    <div class="row">
        <table class="table table-hover">
            <tr>
                <th>
                    <?= $this->Paginator->sort('Employees.name','Name') ?>
                    <?php if( $this->Paginator->config('options.url.sort') == "Employees.name" ):?>
                        <span class="glyphicon glyphicon-triangle-<?= ($this->Paginator->config('options.url.direction') == "asc")?"top":"bottom"; ?>"></span>
                    <?php endif;?>
                </th>
                <th>
                    <?= $this->Paginator->sort('Employees.surname','Surname') ?>
                    <?php if( $this->Paginator->config('options.url.sort') == "Employees.surname" ):?>
                        <span class="glyphicon glyphicon-triangle-<?= ($this->Paginator->config('options.url.direction') == "asc")?"top":"bottom"; ?>"></span>
                    <?php endif;?>
                </th>
                <th>
                    <?= $this->Paginator->sort('Employees.email','Email address') ?>
                    <?php if( $this->Paginator->config('options.url.sort') == "Employees.email" ):?>
                        <span class="glyphicon glyphicon-triangle-<?= ($this->Paginator->config('options.url.direction') == "asc")?"top":"bottom"; ?>"></span>
                    <?php endif;?>
                </th>
                <th>
                    <?= $this->Paginator->sort('Employees.employment_date','Employment date') ?>
                    <?php if( $this->Paginator->config('options.url.sort') == "Employees.employment_date" ):?>
                        <span class="glyphicon glyphicon-triangle-<?= ($this->Paginator->config('options.url.direction') == "asc")?"top":"bottom"; ?>"></span>
                    <?php endif;?>
                </th>
                <th></th>
            </tr>
        <?php foreach($employees as $employee):?>
            <tr>
                <td><?= __($employee->name) ?></td>
                <td><?= __($employee->surname) ?></td>
                <td><?= __($employee->email) ?></td>
                <td><?= __($employee->employment_date->i18nFormat('YYYY-MM-dd')) ?></td>
                <td>
                    <button data-toggle="modal" data-target="#ajaxModal" data-type="form" data-title="Edit details for <?= __(ucfirst($employee->name) . ' ' . ucfirst($employee->surname) )?>" data-ajaxUrl="<?= $this->Url->build(['controller' => 'Employees', 'action' => 'edit', $employee->id])?>" type="button"  class="btn btn-primary"><?= __("Edit") ?></button>
                    <button data-toggle="modal" data-target="#ajaxModal" data-type="confirm" data-message="Are you sure you want to delete <b><?= __(ucfirst($employee->name) . ' ' . ucfirst($employee->surname) )?></b> from the system?" data-title="Delete employee" data-ajaxUrl="<?= $this->Url->build(['controller' => 'Employees', 'action' => 'delete', $employee->id])?>" type="button" class="btn btn-danger"><?= __("Delete") ?></button>
                </td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
        </table>
        <?php if( $this->Paginator->numbers() ):?>
        <div class="paginator text-center">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>
        <?php endif;?>
    </div>
</div>
