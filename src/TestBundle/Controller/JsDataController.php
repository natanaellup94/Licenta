<?php
/**
 * Created by PhpStorm.
 * User: natanael.lup
 * Date: 7/27/2016
 * Time: 1:42 PM
 */

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Zitec\JSDataBundle\DataCollector\DefaultDataCollector;

class JsDataController extends Controller
{
    public function jdDataAction(Request $request)
    {
        $dataCollector = new DefaultDataCollector();
        $arrayIndex = 0;
        $arrayWithPaths = array('testFirstPath', 'testSecondPath');
        $arrayWithValues = array('testFirtValue', 'testSecondValue');

        $dataCollector->add("[$arrayWithPaths[$arrayIndex]]",$arrayWithValues[$arrayIndex]);
        $arrayIndex++;

        $dataCollector->merge(array($arrayWithPaths[$arrayIndex] => $arrayWithValues[$arrayIndex]));


        $jsDataHandler = $this->get('zitec.js_data.data_handler');
        $categories = 'test';
        $jsDataHandler->add('[Category]',$categories);

        return $this->render('TestBundle:JsData:test.html.twig');
    }
}