# Code Easy DB #

Code Easy DB manage easy databases connection, improve and make secure connections and queries.

This repository contains secure rules for update, insert and select queries.

Prevents accidental updates.

## Design goals ##

Code Easy DB help for make projects from scratch.

* Contains secure rules for update, insert and select queries.
* Prevents accidental updates.
* [Learn Markdown](https://github.com/code2514/code-easy-db)

## Usage ##

Need modify config.php in ./src/config.php with database info.

### Select estructure ###

```php

<?php

require("autoload.php");


$selectData = new select();

$selectData->table("table_name alias");
$selectData->addSelect(" alias.field1 "); // Delete this line return all fields.
$selectData->addCondition("alias.field2 = 'name'");
$selectData->limit(2); // Limit number results, zero get all rows.
$selectData->run();

//After run obtains

$selectData->getTotal(); // Query total rows.
$selectData->getResults(); // Query results in PHP array.
$selectData->getQuery(); // Structure of final query.
$selectData->getError(); // Show error status.


?>
```

### Update estructure ###

```php

<?php

require("autoload.php");


$updateData = new update;

$updateData->table("table_name"); // table to update.
$updateData->addSet("name_field_1", $value1); // Value to change.
$updateData->addSet("name_field_1", 20);
$updateData->addSet("name_field_1", "value");
$updateData->addCondition("alias.field2 = 'name'"); // where condition
$updateData->limit(2); // Limit number of affected rows, zero get all rows. Default limit 1 for prevents accidentally updates.
$updateData->run();

//After run obtains

$updateData->getQuery(); // Structure of final query.
$updateData->getError(); // Show error status.


?>
```

### Insert estructure ###

```php

<?php

require("autoload.php");


$insertData = new update;

$insertData->table("table_name"); // table to insert.
$insertData->addValue("name_field_1", $value1); // Value to insert.
$insertData->addValue("name_field_1", 20);
$insertData->addValue("name_field_1", "value");
$insertData->run();

//After run obtains

$insertData->getQuery(); // Structure of final query.
$insertData->getError(); // Show error status.


?>
```

## Other examples ##

### Simple select query get all data ###

```php

<?php

require("autoload.php");


$selectData = new select;

$selectData->table("table_name alias");
$selectData->run();

//After run obtains

$results = $selectData->getResults(); // Query results in PHP array.

foreach( $results as $row){
   echo $row['name_field1'];
}


?>
```

### Contact ###

* Code - code.atl@gmail.com
* WCode.mx
