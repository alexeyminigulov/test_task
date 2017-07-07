<?php

namespace App\Business;

use File;
use Config;
use Intervention\Image\Facades\Image;
use App\Business\PhotoEmployer;

class Photo
{
    private $imageSize = [
        'medium' => [ 'width' => null, 'height' => null ],
        'min' => [ 'width' => null, 'height' => null ]
    ];
    private $proportion;
    private $widthImg;
    private $heightImg;
    private $file;
    private $nameImg;

    public function __construct( $file )
    {
        $this->file = $file;
        $this->nameImg = new PhotoEmployer( $this->file );
        $this->prepareImage( $this->file );
    }

    private function prepareImage(&$file) {

        $this->widthImg = Image::make($file)->width();
        $this->heightImg = Image::make($file)->height();

        if( $this->widthImg > $this->heightImg ) {
            $this->proportion = $this->widthImg / $this->heightImg;
            $this->imageSize['medium']['width']  = Config::get('settingimg.employer_img')['medium']['width'];
            $this->imageSize['medium']['height'] = intval($this->imageSize['medium']['width'] / $this->proportion);
            $this->imageSize['min']['width']  = Config::get('settingimg.employer_img')['min']['width'];
            $this->imageSize['min']['height'] = intval($this->imageSize['min']['width'] / $this->proportion);
        } else {
            $this->proportion = $this->heightImg / $this->widthImg;
            $this->imageSize['medium']['height']  = Config::get('settingimg.employer_img')['medium']['height'];
            $this->imageSize['medium']['width'] = intval($this->imageSize['medium']['height'] / $this->proportion);
            $this->imageSize['min']['height']  = Config::get('settingimg.employer_img')['min']['height'];
            $this->imageSize['min']['width'] = intval($this->imageSize['min']['height'] / $this->proportion);
        }
    }

    public function save() {

        $imageFile = Image::make($this->file);
        if( $this->imageSize['medium']['width'] > $this->imageSize['medium']['height'] ) {

            $imageFile->fit( $this->imageSize['medium']['width'], $this->imageSize['medium']['height'] )
                ->save( public_path() . '/img/' . $this->nameImg->getNameMediumImg() );
            $imageFile->fit( $this->imageSize['min']['width'], $this->imageSize['min']['height'] )
                ->save( public_path() . '/img/' . $this->nameImg->getNameMinImg() );
        }
        else {

            $background = Image::canvas(Config::get('settingimg.employer_img')['medium']['width'], Config::get('settingimg.employer_img')['medium']['height'], '#ffffff');
            $image = $imageFile->fit($this->imageSize['medium']['width'], $this->imageSize['medium']['height']);
            $background->insert($image, 'center')->save(public_path() . '/img/' . $this->nameImg->getNameMediumImg() );

            $background = Image::canvas(Config::get('settingimg.employer_img')['min']['width'], Config::get('settingimg.employer_img')['min']['height'], '#ffffff');
            $image = $imageFile->fit($this->imageSize['min']['width'], $this->imageSize['min']['height']);
            $background->insert($image, 'center')->save(public_path() . '/img/' . $this->nameImg->getNameMinImg() );
        }
    }

    public function getSource() {
        return $this->nameImg->getName();
    }
}