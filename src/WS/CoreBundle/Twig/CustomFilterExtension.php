<?php
/**
 * Created by PhpStorm.
 * User: Aurelien KOUAM
 * Date: 28/11/2016
 * Time: 23:50
 */

namespace WS\CoreBundle\Twig;


class CustomFilterExtension extends \Twig_Extension {

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('country', array($this, 'countryFilter')),
            new \Twig_SimpleFilter('dateTimeLocale', array($this, 'dateTimeLocaleFilter')),
            new \Twig_SimpleFilter('dateLocale', array($this, 'dateLocaleFilter')),
            new \Twig_SimpleFilter('sortByNivExpertise', array($this, 'sortByNivExpertiseFilter')),
        );
    }

    public function countryFilter($countryCode, $locale = "en") {
        $c = \Symfony\Component\Locale\Locale::getDisplayCountries($locale);
        return array_key_exists($countryCode, $c) ? $c[$countryCode] : $countryCode;
    }

    public function dateTimeLocaleFilter($date, $locale) {
        if ($locale == "en") {
            return date_format($date, date('Y-m-d g:i a'));
        } else if ($locale == "fr") {
            return date_format($date, date('d-m-Y à H:i'));
        }
    }

    public function dateLocaleFilter($date, $locale) {
        if ($locale == "en") {
            return date_format($date, date('Y-m-d'));
        } else if ($locale == "fr") {
            return date_format($date, date('d-M-Y'));
        }
    }

    public function sortByNivExpertiseFilter($list) {
        for($i = 0; $i < count($list); $i++){
            for($j = 0; $j < count($list); $j++){
                if ($list[$i]->getNivExpertise() >= $list[$j]->getNivExpertise()) {
                    $x =  $list[$i];
                    $list[$i] = $list[$j];
                    $list[$j] = $x;
                }
            }
        }
        return $list;
    }

    public function getName()
    {
        return 'customfilter_extension';
    }

}