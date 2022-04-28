<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\CustomerController;
use App\Repository\CustomerRepository as CustomerRepository;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
//        return $this->redirectToRoute('home');

//        $customer=new CustomerController(CustomerRepository);
//        $data=$customer->index();
        return $this->render('index.html.twig');
    }

//    /**
//     * @Route("/")
//     */
//    public function home(): Response
//    {
//
//    return $this->render('index.html.twig');
//
//    }
}