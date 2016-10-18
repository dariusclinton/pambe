<?php

namespace WS\UserBundle\Twig;

use Symfony\Component\Intl\Intl;
/**
 * Created by PhpStorm.
 * User: Aurelien KOUAM
 * Date: 17/10/2016
 * Time: 13:18
 */
class CountryExtension extends \Twig_Extension {

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('country', array($this, 'countryFilter')),
        );
    }

    public function countryFilter($countryCode,$locale = "en"){
        $c = \Symfony\Component\Locale\Locale::getDisplayCountries($locale);

        return array_key_exists($countryCode, $c)
            ? $c[$countryCode]
            : $countryCode;
    }

    public function getName()
    {
        return 'country_extension';
    }

}