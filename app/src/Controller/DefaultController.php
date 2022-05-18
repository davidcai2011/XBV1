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
    #[Route('/customer', name: 'customer_list', methods: 'GET')]
    public function customerAction()
    {
//        return $this->redirectToRoute('home');

//        $customer=new CustomerController(CustomerRepository);
//        $data=$customer->index();
        return $this->render('index.html.twig');
    }

    #[Route('/product', name: 'product_list', methods: 'GET')]
    public function productAction()
    {
//        return $this->redirectToRoute('home');

//        $customer=new CustomerController(CustomerRepository);
//        $data=$customer->index();
        return $this->render('product.html.twig');
    }
    #[Route('/invoice', name: 'invoice_detail', methods: 'GET')]
    public function invoiceAction()
    {
//        return $this->redirectToRoute('home');

//        $customer=new CustomerController(CustomerRepository);
//        $data=$customer->index();
        return $this->render('invoice.html.twig');
    }
    #[Route('/invoice_new', name: 'invoice_new', methods: 'GET')]
    public function invoiceNewAction()
    {
//        return $this->redirectToRoute('home');

//        $customer=new CustomerController(CustomerRepository);
//        $data=$customer->index();
        return $this->render('invoice_new.html.twig');
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