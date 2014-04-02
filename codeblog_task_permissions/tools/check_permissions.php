<?php

$pk = PermissionKey::getByHandle('shutdown_planet');
if ($pk->can()) {
    echo t('Yes you are allowed to shutdown the planet');
} else {
    echo t('We are sorry but you have no permissions to shutdown the planet');
}

echo "<br/>\n";

$pk = PermissionKey::getByHandle('make_weather_nice');
if ($pk->can()) {
    echo t('You can change the weather');
} else {
    echo t('No way for you to change the weather');
}