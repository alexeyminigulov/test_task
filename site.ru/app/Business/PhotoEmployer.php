<?php

namespace App\Business;

class PhotoEmployer
{
    private $medium;
    private $min;

    public function __construct($file)
    {
        $this->medium = time() . '_medium.' . $file->getClientOriginalExtension();
        $this->min = time() . '_min.' . $file->getClientOriginalExtension();
    }

    public function getNameMediumImg() {
        return $this->medium;
    }

    public function getNameMinImg() {
        return $this->min;
    }

    public function getName() {

        return '{"min": "' . $this->getNameMinImg() . '", "medium": "' . $this->getNameMediumImg() . '"}';
    }

}