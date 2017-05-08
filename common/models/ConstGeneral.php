<?php
namespace  common\models;
/**
 * Created by PhpStorm.
 * User: TuanPham
 * Date: 5/8/2017
 * Time: 2:20 PM
 */
class ConstGeneral {
    // quyen cho dang nhap
    const GUESTS = 'GUESTS';
    const REGISTERED = 'REGISTERED';
    const REGISTERED_COPPA = 'REGISTERED_COPPA';
    const BOTS = 'BOTS';
    const NEWLY_REGISTERED = 'NEWLY_REGISTERED';
    const MOD = 'GLOBAL_MODERATORS';
    const ADMIN = 'ADMINISTRATORS';

    const GUESTS_ID = 1;
    const REGISTERED_ID = 2;
    const REGISTERED_COPPA_ID = 3;
    const BOTS_ID = 6;
    const NEWLY_REGISTERED_ID = 7;
    const MOD_ID = 4;
    const ADMIN_ID = 5;


    // quyen admin
    const ROLE_ADMIN_STANDARD = 'ROLE_ADMIN_STANDARD';
    const ROLE_ADMIN_FORUM = 'ROLE_ADMIN_FORUM';
    const ROLE_ADMIN_USERGROUP = 'ROLE_ADMIN_USERGROUP';
    const ROLE_ADMIN_FULL = 'ROLE_ADMIN_FULL';

    // quyen user
    const ROLE_USER_FULL = 'ROLE_USER_FULL';
    const ROLE_USER_STANDARD = 'ROLE_USER_STANDARD';
    const ROLE_USER_LIMITED = 'ROLE_USER_LIMITED';
    const ROLE_USER_NOPM = 'ROLE_USER_NOPM';
    const ROLE_USER_NOAVATAR = 'ROLE_USER_NOAVATAR';
    const ROLE_USER_NEW_MEMBER = 'ROLE_USER_NEW_MEMBER';

    // quyen mod
    const ROLE_MOD_FULL = 'ROLE_MOD_FULL';
    const ROLE_MOD_STANDARD = 'ROLE_MOD_STANDARD';
    const ROLE_MOD_SIMPLE = 'ROLE_MOD_SIMPLE';
    const ROLE_MOD_QUEUE = 'ROLE_MOD_QUEUE';

    // quyen forum
    const ROLE_FORUM_FULL = 'ROLE_FORUM_FULL';
    const ROLE_FORUM_STANDARD = 'ROLE_FORUM_STANDARD';
    const ROLE_FORUM_NOACCESS = 'ROLE_FORUM_NOACCESS';
    const ROLE_FORUM_READONLY = 'ROLE_FORUM_READONLY';
    const ROLE_FORUM_LIMITED = 'ROLE_FORUM_LIMITED';
    const ROLE_FORUM_BOT = 'ROLE_FORUM_BOT';
    const ROLE_FORUM_ONQUEUE = 'ROLE_FORUM_ONQUEUE';
    const ROLE_FORUM_POLLS = 'ROLE_FORUM_POLLS';
    const ROLE_FORUM_LIMITED_POLLS = 'ROLE_FORUM_LIMITED_POLLS';
    const ROLE_FORUM_NEW_MEMBER = 'ROLE_FORUM_NEW_MEMBER';

    public static function permissionAdmin()
    {
        $ls = [
            1=>self::ROLE_ADMIN_STANDARD,
            2=>self::ROLE_ADMIN_FORUM,
            3=>self::ROLE_ADMIN_USERGROUP,
            4=>self::ROLE_ADMIN_FULL,
        ];
        return $ls;
    }

    public static function permissionUser()
    {
        $ls = [
            5=>self::ROLE_USER_FULL,
            6=>self::ROLE_USER_STANDARD,
            7=>self::ROLE_USER_LIMITED,
            8=>self::ROLE_USER_NOPM,
            9=>self::ROLE_USER_NOAVATAR,
            23=>self::ROLE_USER_NEW_MEMBER,
        ];
        return $ls;
    }

    public static function permissionMod()
    {
        $ls = [
            10=>self::ROLE_MOD_FULL,
            11=>self::ROLE_MOD_STANDARD,
            12=>self::ROLE_MOD_SIMPLE,
            13=>self::ROLE_MOD_QUEUE,
        ];
        return $ls;
    }

    public static function permissionForum()
    {
        $ls = [
            14=>self::ROLE_FORUM_FULL,
            15=>self::ROLE_FORUM_STANDARD,
            16=>self::ROLE_FORUM_NOACCESS,
            17=>self::ROLE_FORUM_READONLY,
            18=>self::ROLE_FORUM_LIMITED,
            19=>self::ROLE_FORUM_BOT,
            20=>self::ROLE_FORUM_ONQUEUE,
            21=>self::ROLE_FORUM_POLLS,
            22=>self::ROLE_FORUM_LIMITED_POLLS,
            24=>self::ROLE_FORUM_NEW_MEMBER,
        ];
        return $ls;
    }


    public static function checkPermissionUserGroup($user_id){
        $group = UserGroup::find()
            ->select('group_id')
            ->andWhere(['user_id'=>$user_id])
            ->all();
        $array = [];
        if(!empty($group)){
            foreach($group as $item){
                $array[] = (int)$item->group_id;
            }
        }
        return $array;
    }
}