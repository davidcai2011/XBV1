<?php

namespace App\Controller;

use App\Api\CustomerApiModel;
use App\Entity\Customer;
use App\Entity\RepLog;
use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use \App\Controller\EntityManagerTrait;

class BaseController extends AbstractController
{
    use EntityManagerTrait;

    /**
 * @param mixed $data Usually an object you want to serialize
 * @param int $statusCode
 * @return JsonResponse
 */
    protected function createApiResponse($data, $statusCode = 200)
    {
        $json = $this->get('serializer')
            ->serialize($data, 'json');

        //  dump($json);
        return new JsonResponse($json, $statusCode, [], true);
    }

    /**
     * @return CustomerApiModel[]
     */
    protected function findAllCustomerModels()
    {
        $customers = $this->getDoctrine()->getRepository(Customer::class)
            ->findAll();


        $models = [];
        foreach ($customers as $customer) {
            $models[] = $this->createCustomerApiModel($customer);
        }

        return $models;
    }
    /**
     * Turns a Customer into a CustomerApiModel for the API.
     *
     * This could be moved into a service if it needed to be
     * re-used elsewhere.
     *
     * @param Customer $customer
     * @return CustomerApiModel
     */
    protected function createCustomerApiModel(Customer $customer)
    {
        $model = new CustomerApiModel();

        $model->id = $customer->getId();
        $model->customerName = $customer->getCustomerName();
        $model->company = $customer->getCompany();


//        $selfUrl = $this->generateUrl(
//            ['id' => $customer->getId()],
//            'customer_get'
//        );

        $selfUrl = $this->generateUrl(
            'customer_get',
            ['id' => $customer->getId()]
        );
        dd($selfUrl);
        $model->addLink('_self', $selfUrl);

        return $model;
    }

}