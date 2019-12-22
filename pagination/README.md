# Auto pagination php, sample with mysql (but can work, i suppose, with other fetching data)

- php : table_pagination.php sample
- php : table_pagination.class
- php : table_pagination_pdo.class for demo (use your own naturally)
- javasvript : table_pagination.js
- css : external bootsrap (use your own naturally)

## Result
- '<ul><li></li>...</ul>'
- |icon_before|1|2|3|current page|icon_next|
- |icon_before|1|2|3|4|current page|5|6|7|8|...|last|icon_next|
- |icon_before|first|...|20|21|22|23|current page|25|26|27|28|...|last|icon_next|
- etc, etc

## Vars php [6] in table_pagination.php (at the end)
* `$pgn_dfltLimit`: n default results
* `$pgn_rCount`: total all results in your table
* `$pgn_paramPage`: name for the url parameters, return current page after process
* `$pgn_paramRes`: name for the url parameters, return result for process
* `$pgn_nBtns`: for ui, number of buttons

## Usage
* `configure pdo`: -> in pdo.class
* `configure vars rseults`: -> in table_pagination.php at the end
* `test`: -> open table_pagination.php
