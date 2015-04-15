<?php
return CMap::mergeArray(
    (require  dirname(__FILE__).'/../../common/config/main.php'),
    (require (dirname(__FILE__) . '/frontend.php'))
);

