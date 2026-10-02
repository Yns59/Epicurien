<?php

namespace App\Repository;

use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function findOneByUserAndDate(User $user, \DateTimeInterface $date): ?Reservation
    {
        $start = \DateTimeImmutable::createFromInterface($date)->setTime(0, 0);
        $end = $start->modify('+1 day');

        return $this->createQueryBuilder('r')
            ->andWhere('r.user = :user')
            ->andWhere('r.date >= :start')
            ->andWhere('r.date < :end')
            ->setParameter('user', $user)
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
