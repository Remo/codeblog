<?php

class CodeblogTaskPermissionsPackage extends Package {

    protected $pkgHandle = 'codeblog_task_permissions';
    protected $appVersionRequired = '5.6.3';
    protected $pkgVersion = '1.0';

    public function getPackageDescription() {
        return t("Installs the Task Permission demo package.");
    }

    public function getPackageName() {
        return t("Task Permissions");
    }

    public function install() {
        $pkg = parent::install();
        $this->installTaskPermissions($pkg);
    }

    /**
     * This method installs our permission keys
     * 
     * @param Package $pkg
     */
    protected function installTaskPermissions($pkg) {
        // add a new permission key to handle shutdons
        $pkShutdownHandle = 'shutdown_planet';
        if (!is_object(PermissionKey::getByHandle($pkShutdownHandle))) {
            $pkShutdown = PermissionKey::add('admin', $pkShutdownHandle, t('Shutdown the planet'), t('Permission to shutdown the planet'), '', '', $pkg);

            // assign administrators the right to handle our planet
            $group = Group::getByID(ADMIN_GROUP_ID);
            $adminGroupEntity = GroupPermissionAccessEntity::getOrCreate($group);

            $pa = PermissionAccess::create($pkShutdown);
            $pa->addListItem($adminGroupEntity);
            $pt = $pkShutdown->getPermissionAssignmentObject();
            $pt->assignPermissionAccess($pa);
        }

        // install a second permission key to control the weather
        $pkWeatherHandle = 'make_weather_nice';
        if (!is_object(PermissionKey::getByHandle($pkWeatherHandle))) {
            $pkWeather = PermissionKey::add('admin', $pkWeatherHandle, t('Remote Weather Control'), t('Access to the remote weather control system'), '', '', $pkg);
        }
    }

}
