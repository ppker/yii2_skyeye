<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $realname;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '/^[a-z][A-Z]*$/i', 'message' => '{attribute}是你邮箱@前面的字母'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '此{attribute}已经被使用'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['realname', 'required'],
            ['realname', 'string', 'min' => 2, 'max' => 6],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '此{attribute}已经被使用'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels() {

        return [
            'username' => '用户名',
            'realname' => '真实姓名',
            'password' => '密码',
            'email' => '企业邮箱'
        ];
    }


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->realname = $this->realname;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
