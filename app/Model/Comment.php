<?php

namespace app\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class Comment {
    private $user;
    private $text;

    public function __construct(User $user, $text) {
        $this->user = $user;
        $this->text = $text;
    }

    public function getUser() {
        return $this->user;
    }

    public function getText() {
        return $this->text;
    }
}