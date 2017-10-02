<?php
/**
 * Created by PhpStorm.
 * User: anilrayamajhi
 * Date: 2/27/17
 * Time: 10:47 AM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }
}