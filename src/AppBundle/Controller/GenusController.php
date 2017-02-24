<?

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{

    /**
     * @Route("/")
     */
    public function homeAction(){
        return $this->render('genus/home.html.twig',[]);
    }


  /**
  * @Route("genus")
  */

  public function showList(){
//    return new Response("LIST PAGE");
  }


    /**
     * @Route("/genus/{genusName}")
     * @Template()
     */


  public function showAction($genusName)
  {
    // $templating = $this->container->get('templating');
    // $html = $templating->render('genus/show.html.twig', [
      // 'nameParam'=>$genusName
    // ]);

    // return new response($html);

    $manchey = ['ganey','pada','lairi', 'syaal'];


    return  $this->render('genus/show.html.twig', [
        'name' => $genusName,
        'notes'=>$manchey
      ]);
    }

  /**
    * @Route("/genus/{genusName}/notes", name="genus_show_notes")
    * @Method("GET")
    */

  public function getNotesAction($genusName){
    $notes = [
      ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec. 10, 2015'],
      ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
      ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
      ['id' => 4, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'Damn!', 'date' => 'Aug. 10, 2015'],
        ];
    $data = [
        'notes' => $notes
    ];

    //JSON API end-point
    // return new Response(json_encode($data));
    return new JsonResponse($data);
    //JsonResponse does two things:
    //  1) call json_encode AND
    //  2) set application/json Content-Type Header

  }
}
