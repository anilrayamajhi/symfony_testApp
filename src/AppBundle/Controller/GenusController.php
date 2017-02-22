<?

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{
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

      $note = ['ganey','pada','lairi'];


      return  $this->render('genus/show.html.twig', [
          'nameParam' => $genusName,
          'note'=>$note
        ]);
    }
}