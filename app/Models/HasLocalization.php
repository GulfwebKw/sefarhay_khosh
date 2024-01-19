<?php

namespace App\Models;

/**
 * @property array  $hastTranslate
 */
trait HasLocalization
{
    private $slugs = [
        'fa' , 'en'
    ];

    public  function initializeHasLocalization()
    {
        $translateAble = $this->getLocalizationAttribute();
        $newField = [];
        foreach ( $translateAble as $item) {
            foreach ( $this->slugs as $slug) {
                $newField[] = $item.'_'.$slug;
            }
        }
        $this->fillable = array_merge(
            $this->fillable ,
            $newField
        );
    }

    public function getLocalizationAttribute(): array
    {
        if ( property_exists($this, "hastTranslate") ) {
            return $this->hastTranslate;
        }
        return  [];
    }

    public function getAttributeValue($key): mixed
    {
        if (! in_array($key , $this->getLocalizationAttribute())) {
            return parent::getAttributeValue($key);
        }
        return parent::getAttributeValue($key.'_'.app()->getLocale() );
    }
}
