<?php

namespace App\Controller;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\Service\Attribute\Required;

trait EntityManagerTrait
{
    protected  ManagerRegistry $managerRegistry;

    #[Required]
    public function setManagerRegistry(ManagerRegistry $managerRegistry): void
    {
        // @phpstan-ignore-next-line PHPStan complains that the readonly property is assigned outside of the constructor.
        $this->managerRegistry = $managerRegistry;
    }

    protected function getDoctrine(?string $name = null, ?string $forClass = null): ObjectManager
    {
        if ($forClass) {
            return $this->managerRegistry->getManagerForClass($forClass);
        }

        return $this->managerRegistry->getManager($name);
    }
}