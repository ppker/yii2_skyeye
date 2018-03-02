<?php
/**
 * Created by PhpStorm.
 * User: ppker
 * Date: 2017/12/14
 * Time: 11:13
 * Desc:
 */

namespace common\helpers;

class Avatar {

    public $email;
    public $size;
    public $gravatar = 'https://www.gravatar.com/avatar/';
    public function __construct($email, $size = 50) {

        $this->email = $email;
        $this->size = $size;
    }

    public function getAvatar() {

        $identicon = new \Identicon\Identicon();
        return $identicon->getImageDataUri($this->email, $this->size);
    }

    /**
     * d, [ 404 | mm | identicon | monsterid | wavatar ]
     * @return string
     */
    protected function _getGravatar() {

        $hash = md5(strtolower(trim($this->email)));
        return sprintf($this->gravatar . '%s?s=%d&d=%s', $hash, $this->size, 'wavatar');
    }

    protected function _validateGravatar() {

        $hash = md5(strtolower(trim($this->email)));
        $uri = $this->gravatar . $hash . '?d=404';
        $headers = @get_headers($uri);
        return preg_match("|200|", $headers[0]) ? true : false;
    }


}