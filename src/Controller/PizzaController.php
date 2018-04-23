<?php
    namespace App\Controller;

    use App\Entity\Pizzeria;

    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Annotation\Route;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class PizzaController extends Controller {
    /**
     *  @Route("/", name="pizzeria_list")
     *  @Method({"GET"})
     */
        public function index() {
            
            $pizzeriat= $this->getDoctrine()->getRepository(Pizzeria::class)->findAll();

            return $this->render('pizzeriat/index.html.twig', array('pizzeriat' => $pizzeriat ));
        }

        /**
         * @Route("/pizzeria/new", name="new_pizzeria")
         * Method({"GET", "POST"})
         */
        public function new(Request $request) {
            $pizzeria = new Pizzeria();

            $form = $this->createFormBuilder($pizzeria)
              ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
              ->add('body', TextareaType::class, array(
                'required' => false,
                'attr' => array('class' => 'form-control')
              ))
              ->add('save', SubmitType::class, array(
                'label' => 'Create',
                'attr' => array('class' => 'btn btn-primary mt-3')
              ))
              ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
              $pizzeria = $form->getData();

              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->persist($article);
              $entityManager->flush();

              return $this->redirectToRoute('pizzeria_list');
            }

            return $this->render('pizzeriat/new.html.twig', array(
              'form' => $form->createView()
            ));
          }

          /**
         * @Route("/pizzeria/edit/{id}", name="edit_pizzeria")
         * Method({"GET", "POST"})
         */
        public function edit(Request $request, $id) {
            $pizzeria = new Pizzeria();
            $pizzeria = $this->getDoctrine()->getRepository(Pizzeria::class)->find($id);

            $form = $this->createFormBuilder($pizzeria)
              ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
              ->add('body', TextareaType::class, array(
                'required' => false,
                'attr' => array('class' => 'form-control')
              ))
              ->add('save', SubmitType::class, array(
                'label' => 'Päivitä',
                'attr' => array('class' => 'btn btn-primary mt-3')
              ))
              ->getForm();

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
            
              $entityManager = $this->getDoctrine()->getManager();
              $entityManager->flush();

              return $this->redirectToRoute('pizzeria_list');
            }

            return $this->render('pizzeriat/edit.html.twig', array(
              'form' => $form->createView()
            ));
          }

        /**
         * @Route("/pizzeria/{id}", name="pizzeria_show")
         */
        public function show($id) {
            $pizzeria = $this->getDoctrine()->getRepository(Pizzeria::class)->find($id);

            return $this->render('pizzeriat/show.html.twig', array('pizzeria' => $pizzeria));
        }

        /**
         * @Route("/pizzeria/delete/{id}")
         * @Method({"DELETE"})
         */
        public function delete(Request $request, $id) {
            $pizzeria = $this->getDoctrine()->getRepository(Pizzeria::class)->find($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pizzeria);
            $entityManager->flush();

            $response = new Response();
            $response->send();
        }

        // /**
    //  * @Route("/pizzeria/save")
    //  */
    // public function save() {
    //   $entityManager = $this->getDoctrine()->getManager();
    //   $pizzeria = new Pizzeria();
    //   $pizzeria->setTitle('Pizzeria two');
    //   $pizzeria->setBody('This is the body for Pizzeria two');
    //   $entityManager->persist($pizzeria);
    //   $entityManager->flush();
    //   return new Response('Saved an pizzeria with the id of  '.$pizzeria->getId());
    // }
    }