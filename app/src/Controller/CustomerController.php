<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Customer;
use App\Repository\CustomerRepository;
use \App\Controller\EntityManagerTrait;
use Doctrine\ORM\EntityManager;


class CustomerController extends BaseController
{

    #[Route('/customers', name: 'customer_list', methods: 'GET')]
    public function index(): Response
    {

        $customers = $this->getDoctrine()->getRepository(Customer::class)
            ->findAll();



        $data = [];

        foreach ($customers as $customer) {
            $data[] = [
                'id' => $customer->getId(),
                'customerName' => $customer->getCustomerName(),
                'company' => $customer->getCompany(),
            ];
        }
        return $this->json($data);

    }

    #[Route('/customers/{id}', name: 'customer_show', methods: 'GET')]
    public function showCustomer(int $id): Response
    {
        $customer = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->find($id);

        if (!$customer) {

            return $this->json('No customer found for id' . $id, 404);
        }

        $data =  [
            'id' => $customer->getId(),
            'customerName' => $customer->getCustomerName(),
            'company' => $customer->getCompany(),
        ];

        return $this->json($data);
    }
    #[Route('/customers?customerName=[re]', name: 'customer_searchName', methods: 'GET')]
    public function searchCustomer(): Response
    {
        $customerName=array("Lisa");
        $customers = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->findBy(
                array(
                    'customerName' =>array( 'remixx'),
                )
                )  ;

        if (!$customers) {

            return $this->json('No customer found', 404);
        }

        $data = [];

        foreach ($customers as $customer) {
            $data[] = [
                'id' => $customer->getId(),
                'customerName' => $customer->getCustomerName(),
                'company' => $customer->getCompany(),
            ];
        }
        return $this->json($data);
    }
    #[Route('/customers', name: 'customer_add', methods: 'POST')]
    public function new(Request $request,  ManagerRegistry $doctrine): Response
    {
        dd($request->request->get('customerName'));
        $entityManager = $doctrine->getManager();

        $customer = new Customer();
        $customer->setCustomerName($request->request->get('customerName'));
        $customer->setCompany($request->request->get('company'));

        $entityManager->persist($customer);
        $entityManager->flush();

        return $this->json('Created new customer successfully with id ' . $customer->getId());
    }

    #[Route('/customers/{id}', name: 'customer_edit', methods: 'PUT')]
    public function editCustomer(Request $request, int $id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $customer = $entityManager
            ->getRepository(Customer::class)
            ->find($id);

        if (!$customer) {
            return $this->json('No customer found for id' . $id, 404);
        }

        $content = json_decode($request->getContent());
        $customer->setCustomerName($content->customerName);
        $customer->setCompany($content->company);

        $entityManager->flush();

        $data =  [
            'id' => $customer->getId(),
            'customerName' => $customer->getCustomerName(),
            'company' => $customer->getCompany(),
        ];
        return $this->json($data);

    }

    #[Route('/customers/{id}', name: 'customer_delete', methods: 'DELETE')]
        public function deleteCustomer(int $id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $customer = $entityManager
            ->getRepository(Customer::class)
            ->find($id);

        if (!$customer) {
            return $this->json('No customer found for id' . $id, 404);
        }

        $entityManager->remove($customer);
        $entityManager->flush();

        return $this->json('Deleted a customer successfully with id ' . $id);
    }

}
