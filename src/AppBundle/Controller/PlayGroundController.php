<?php
/**
 * Created by PhpStorm.
 * User: anilrayamajhi
 * Date: 10/2/17
 * Time: 2:04 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\GenusNote;
use AppBundle\Service\MarkdownTransformer;
use Faker\Provider\cs_CZ\DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class PlayGroundController extends Controller
{
    /**
     * @Route("/playground", name="play_ground")
     */


    public function playAction() {
//        return new Response('<html><body style="">🖕🏿</body></html>')
        return $this->render('interact/playground.html.twig',[]);
    }

}