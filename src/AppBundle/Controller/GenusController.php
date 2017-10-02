<?php

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

use AppBundle\Entity\Genus;

class GenusController extends Controller
{

//    /**
//     * @Route("/")
//     */
//    public function homeAction(){
//        return $this->render('genus/homepage.html.twig',[]);
//    }



    /**
     * @Route("/genus/new", name="new_genus")
     */
    public function newAction()
    {

        $genus = new Genus();

        $genus->setName('Octopus'.rand(1, 100));
        $genus->setSubFamily('Octopodinae');
        $genus->setSpeciesCount(rand(100, 99999));

        $note = new GenusNote();

        $note->setUsername('AquaWeaver');
        $note->setUserAvatarFilename('ryan.jpeg');
        $note->setNote('I counted 8 legs... as they wrapped around me');
        $note->setCreatedAt(new \DateTime('-1 month'));

//      em == entity manager
        $em = $this->getDoctrine()->getManager();

        $em->persist($genus); #save genus
        $em->persist($note);
        $em->flush();  #queries data

        return new Response('<html><body>created!</body></html>');
    }


  /**
  * @Route("/genus", name="list_genus")
  */

  public function listAction(){
//    return new Response("LIST PAGE");
      //fetch the entity manager $em
      $em = $this->getDoctrine()->getManager();

      $genuses = $em->getRepository('AppBundle:Genus')
          ->findAllPublishedOrderedByRecentlyActive();

//      dump($genuses);die;
      return $this->render('genus/list.html.twig', ['genuses' => $genuses]);
  }


    /**
     * @Route("/genus/{genusName}", name="genus_show")
     * @Template()
     */


  public function showAction($genusName)
  {
    // $templating = $this->container->get('templating');
    // $html = $templating->render('genus/show.html.twig', [
      // 'nameParam'=>$genusName
    // ]);

    // return new response($html);

//    $funFact = 'Octopuses can change the color of their body in just *three-tenths* of a second!';
//    // Accessing the container/bundle with get()
//      //Alternative way: $funFact = $this->container->get('markdown.parser')->transform($funFact);
//
//      //Accessing the cache bundle/ service ID
//      $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
//      $key = md5($funFact);
//
//      // $cache->contains($key) :
//      // makes sure same string does not get passed through same markdown
//      if($cache->contains($key)){
//          $funFact = $cache->fetch($key);
//      }
//      else{
//          sleep(1); // make page initial load 1 sec slower to test cache
//          $funFact = $this->get('markdown.parser')
//              ->transform($funFact);
//          $cache->save($key, $funFact);
//      }

      $em = $this->getDoctrine()->getManager();
      $genus = $em->getRepository('AppBundle:Genus')
          ->findOneBy(['name' => $genusName]);

//    $manchey = ['ganey','pada','lairi', 'syaal'];
      if(!$genus) {
          throw $this->createNotFoundException('genus not found');
      }

      $markdownParser = new MarkdownTransformer();
      $funFact = $markdownParser->parse($genus->getFunFact());

//      $recentNotes = $genus->getNotes()->filter(function(GenusNote $note){
//          return $note->getCreatedAt() > new \DateTime('-3 months');
//      });

         $recentNotes = $em->getRepository('AppBundle:GenusNote')
            ->findAllRecentNotesForGenus($genus);

//      dump($genus->getNotes());die;
        return  $this->render('genus/show.html.twig', [
//        'name' => $genusName,
//        'notes'=>$manchey,
//        'funFact' => $funFact,
        'genus' => $genus,
        'recentNoteCount' => count($recentNotes)
      ]);
    }

  /**
    * @Route("/genus/{name}/notes", name="genus_show_notes")
    * @Method("GET")
    */

  public function getNotesAction(Genus $genus){
//      dump($genus);

      $notes = [];
      foreach ($genus->getNotes() as $note) {
          $notes[] = [
              'id' => $note->getId(),
              'username' => $note->getUsername(),
              'avatarUri' => '/images/'.$note->getUserAvatarFilename(),
              'note' => $note->getNote(),
              'date' => $note->getCreatedAt()->format('M d, Y')
          ];
      }



      $data = [
          'notes' => $notes
      ];



//    $notes = [
//      ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec. 10, 2015'],
//      ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
//      ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
//      ['id' => 4, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'Damn!', 'date' => 'Aug. 10, 2015'],
//        ];
//    $data = [
//        'notes' => $notes
//    ];

      //JSON API end-point
      // return new Response(json_encode($data));
      return new JsonResponse($data);
      //JsonResponse does two things:
      //  1) call json_encode AND
      //  2) set application/json Content-Type Header

  }
}
