# Auto pagination php, sample with mysql 
## can work, i suppose, with other fetching data

```php
<?php              
    require 'pagination.php';
?>
```

- php : index.php sample page
- php : pgn.class.php
- javasvript ES6: pgn.js
- //
- php : pgn_pdo.class.php for demo (use your own naturally)
- css : external bootsrap (use your own naturally)

## Result
- http://  127.0.0.1/table_pagination.php?yourparam=johnDOE&page=19&n_result=5
- '< ul >< li >< /li >...< /ul >'
- |icon_before|1|2|3|current page|icon_next|
- |icon_before|1|2|3|4|current page|5|6|7|8|...|last|icon_next|
- |icon_before|first|...|20|21|22|23|current page|25|26|27|28|...|last|icon_next|
- etc, etc

## Vars php [6] in pagination.php
* `$pgn_dfltLimit`: n default results
* `$pgn_rCount`: total all results in your table
* `$pgn_paramPage`: name for the url parameters, return current page after process
* `$pgn_paramRes`: name for the url parameters, return result for process
* `$pgn_nBtns`: for ui, number of buttons, tot max visible btn = n*2 +1 (without first and last)
* `$pgn_ics`: first, last and ... buttons look

## Vars php [3] in index.php
```php
  $pgn_limit       = 15;          // !Important same as $pgn_dfltLimit value as in pagination.php
  $pgn_paramPage   = 'page';      // !Important same value as in pagination.php
  $pgn_paramRes    = 'n_result';  // !Important same value as in pagination.php
```
## Vars js [1] in pgn.js
* `var classname`: line1 IMPORTANT n_result should be same as $pgn_paramRes

## Usage
* `configure pdo`: -> in pdo.class
* `select your table, etc`: -> in index.php line 6, this my own vars for this sample;
* `test`: -> open table_pagination.php
* `re configure vars pagination`: -> in pagination.php
* `test again`: -> open table_pagination.php

## Features
* `get parameters`: don't destruct your own url parameters
* `pagination ui`: several possible on the same page (top, bottom)
* `twig`: usage possible

## TODO
- php class, arg , twig or not twig that is the question
- twig doc, wip
