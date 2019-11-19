<?php
/**
 * Created by PhpStorm.
 * User: Hlib Dresviannikov
 * Date: 19.11.2019
 * Time: 5:58
 */

namespace abstractCRUD\example\models;

use warkeeper\yii2_contracts\IAdminUser;

class AdminUser implements IAdminUser
{
    const ROLE_ADMIN = 1;

    public static function getAdminRole()
    {
        return self::ROLE_ADMIN;
    }

}