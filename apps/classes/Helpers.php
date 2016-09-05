<?php
/**
 * Get config on yml. default app.yml
 * @param $value @ymlFilename.foo.bar or foo.bar
 * @return mixed
 */
function config($value) {
    return aafwApplicationConfig::getInstance()->query($value);
}
