<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ApiResource(
 *
 * )
 *@ApiFilter(SearchFilter::class, properties={"customerName": "partial"})
 *
 */
#[ORM\Entity(repositoryClass: CustomerRepository::class)]
#[ApiResource(attributes: ["pagination_client_items_per_page" => true, "pagination_items_per_page" => 5 ])]

class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $customerName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $company;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    public function setCustomerName(string $customerName): self
    {
        $this->customerName = $customerName;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

        return $this;
    }
}
