# Flip.id PHP Code Style Guide

We created this guide in an attempt to make our code more readable and easier to maintain.

## Coding Standard

Our coding standard will mostly follow [PSR1](http://www.php-fig.org/psr/psr-1/) and [PSR2](http://www.php-fig.org/psr/psr-2/) standard, so take your time to read that article thoroughly. For any addition or exception from the standard, we will provide the details in this guide.

### Key Overview
* Files MUST use only `<?php` and `<?=` tags.
* Class names MUST be declared in `StudlyCaps`.
* Class constants MUST be declared in all upper case with underscore separators.
* Method names MUST be declared in `camelCase`.
* Code MUST use 4 spaces for indenting, not tabs.
* Opening braces for classes MUST go on the next line, and closing braces MUST go on the next line after the body.
* Opening braces for control structures MUST go on the same line, and closing braces MUST go on the next line after the body.

### Addition
* If possible, always use double quote `""` to enclose a string to enable embedding a variable.
* Embedded variable inside a string should be enclosed by a curly bracket: `"this is a {$var}"`.
* Method level variable MUST be declared in `$under_score`.
* Class level properties MUST be declared in `$camelCase`

### Documentation
* to-do

### Exception
* We're not so crazy about space actually. So as long as your code is easily readable, you can omit some strict space rules such as in the [control structures](http://www.php-fig.org/psr/psr-2/#control-structures) section.
* Opening braces for methods can EITHER go on the next line OR on the same line.

### Tips
* Text editor or IDE usually can help you with indentation so that every time you hit the `Tab` key it will actually give you 4 spaces.


## OOP Tips
* Do not overuse static method. Use it to refer to the object as a whole and not a specific instance.
```php
<?php

//correct
Transaction::findById($id);
Transaction::getStatusMap();

//wrong
Transaction::cancelTransaction($id);
// should be
$transaction->cancel();
```

## Flip.id Specific Rules
* MySQL transaction should only be declared on the controller level, not model, to prevent any unwanted nested transaction. If you want to ensure that a method is only called within a MySQL transaction, you can check if there's a transaction running and throw an exception if there isn't.
* Currently, nothing is allowed on the `beforeSave` method on any model.
* Currently, only Log writing is allowed on the `afterSave` method on any model.
