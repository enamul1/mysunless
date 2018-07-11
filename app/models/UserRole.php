<?php

class UserRole extends BaseModel {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_role';

    const ROLE_ADMIN = 'admin';
    const ROLE_CLIENT = 'client';
    const ROLE_CUSTOMER = 'customer';
    
    const ADMIN_ROLE_ID = 1;
    const CLIENT_ROLE_ID = 2;
    const CUSTOMER_ROLE_ID = 3;

    /**
     * is a admin user
     *
     * @param int $userId
     * @return Boolean
     */
    public static function isAdminUser($userRoleId = 0)
    {
        if (!$userRoleId) {
            $user = Auth::user();
            if (!$user instanceof User) {
                return false;
            }
            $userRoleId = $user->users_role;
        }
        $role = self::find($userRoleId);

        if ($role instanceof UserRole) {
            return $role->role == self::ROLE_ADMIN;
        }
        return false;
    }

    /**
     * is a staff user
     *
     * @param int $userId
     * @return Boolean
     */
    public static function isCustomer($userRoleId = 0)
    {
        if (!$userRoleId) {
            $user = Auth::user();
            if (!$user instanceof User) {
                return false;
            }
            $userRoleId = $user->users_role;
        }
        $role = self::find($userRoleId);

        if ($role instanceof UserRole) {
            return $role->role == self::ROLE_CUSTOMER;
        }
        return false;
    }

    /**
     * see if a user a resource permission
     *
     * @param $resource
     * ** list of possible values **
     * ** edit-users | edit-customers | place-orders | edit-orders | edit-pools | edit-drivers **
     *
     */
    public static function hasPermission($resource)
    {
        $user = Auth::user();
        if (!$user instanceof User) {
            return false;
        }

        $roleId = $user->users_roleId;
        if ($resource == 'edit-users') {
            if (self::isAdminUser($roleId)) {
                return true;
            }
            return false;
        }

        if ($resource == 'edit-clients') {
            if (self::isAdminUser($roleId) || self::isCustomer($roleId)) {
                return true;
            } 
            return false;
        }
        
    	if ($resource == 'edit-admins') {
            if (self::isAdminUser($roleId)) {
                return true;
            }
            return false;
        }

        if ($resource == 'edit-videos') {
            if (self::isAdminUser($roleId)) {
                return true;
            }
            return false;
        }

        if ($resource == 'edit-events') {
            if (self::isAdminUser($roleId) || self::isCustomer($roleId)) {
                return true;
            }
            return false;
        }

        if ($resource == 'show-videos') {
            if (self::isAdminUser($roleId) || self::isCustomer($roleId)) {
                return true;
            }
            return false;
        }


    }
}
