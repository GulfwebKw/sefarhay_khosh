<?php

namespace App\Models;

use Illuminate\Support\Str;

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
        $this->appends = array_merge(
            $this->appends ,
            $translateAble
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

    public function __call($method, $parameters)
    {
        foreach ( $this->getLocalizationAttribute() as $item )
            if ( $method == 'get'.Str::studly($item).'Attribute') {
                return parent::getAttributeValue($item.'_'.app()->getLocale() );
            }
        return parent::__call($method, $parameters);
    }
}
