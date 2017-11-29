<?php


namespace Classes\UTI;
use Classes\App;

/**
 * Created by PhpStorm.
 * User: gat
 * Date: 15/11/17
 * Time: 16:32
 */

class ConnexionManager
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }


    /**
     * @return mixed
     */
    public function isInformationGood($login, $passwd)
    {

        $mdpMd5 = $this->tradMdp($passwd);
        $pers = $this->user->getPersByLoginMdp($login, $mdpMd5);
        if (empty($pers)){
            return false;
        }
        return true;
    }

    /**
     * @return PersManager
     */
    public function tradMdp($passwd)
    {
        $salt = '48@!alsd';
        return md5(md5($passwd).$salt);
    }

    public function generateImage()
    {
        return rand(1,9);;
    }
    // user6 10294 2008
}