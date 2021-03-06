<?php


class Employee extends AppModel {

    public $name = 'Employee';

    public $primaryKey = 'id';

    public $useDbConfig = 'default';

    public $useTable = 'employee';

    public $belongsTo = array(
        'Department' => array(
            'className' => 'Department',
            'foreignKey' => 'dpt_id'
        )
    );

}