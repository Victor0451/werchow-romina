Fete_ViewControl_DataGrid has been written by Nguyen Duc Thuan <me@ndthuan.com>. This class can be used to display a 2-dimensions array of data as a grid.

EXAMPLE INSTALLATION:

1.Create a mysql database:
    create database fetesample charset utf8 collate utf8_unicode_ci;
2. Import example.sql from command line:
    mysql -uyourmysqluser -pyourmysqlpassword fetesample < /path/to/example.sql;
3. Change connection params in example.php
4. Access example.php from a browser and see the outputs.

GETTING STARTED:

- GET THE GRID DISPLAYED
$rows = array(
    array('id' => '1', 'name' => 'A'),
    array('id' => '2', 'name' => 'B'),
    array('id' => '3', 'name' => 'C')
);
$grid = Fete_ViewControl_DataGrid::getInstance($rows);
$grid->setup(array(
    'id' => array('header' => 'ID')
    'name' => array('header' => 'Name')
))
->render();

ADVANCED USAGES:

- Variables that you can use within the cell template:
%data%          This variable will be replaced by the cell data itself
%counter%       This will be replaced by the row counter (the starting counter can be change by use setStartingCounter method)
$some_column$   This will be replaced by the value of the column on that row. For example, in the array above, $name$ can be A, B or C; $id$ can be 1, 2 or 3
[[someFunction:param1,param2,param3]] will be replaced by the value of someFunction('param1', 'param2', 'param3')

- TO ENABLE SORTING:
$grid->enableSorting(true);

- TO REMOVE A COLUMN:
$grid->removeColumn('id');

- TO CHANGE ALTERNATIVE ROWS CSS CLASS:
$grid->setAlterRowClass('someCssClass');

- TO ADD A CUSTOM COLUMN AFTER DATA COLUMNS:
$grid->addColumnAfter('column_name', 'cell template', 'column header', array_of_cell_attributes);