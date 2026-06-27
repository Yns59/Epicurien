<?php

namespace App\Repository;

use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Repository pour l'entité Reservation.
 * Hérite de ServiceEntityRepository qui fournit déjà des méthodes utiles
 * comme find(), findAll(), findBy(), findOneBy()...
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        // On indique au parent quelle entité ce repository gère (Reservation),
        // ce qui permet à Doctrine de savoir sur quelle table travailler.
        parent::__construct($registry, Reservation::class);
    }

    /**
     * Cherche une réservation existante pour un utilisateur donné, à une date donnée.
     * Utile pour vérifier "est-ce que cet utilisateur a déjà réservé aujourd'hui ?"
     *
     * @param User $user L'utilisateur connecté pour lequel on vérifie
     * @param \DateTimeInterface $date La date du jour à vérifier (sans tenir compte de l'heure)
     * @return Reservation|null Retourne la réservation trouvée, ou null si aucune n'existe
     */
    public function findOneByUserAndDate(User $user, \DateTimeInterface $date): ?Reservation
    {
        // On clone la date reçue pour ne pas modifier l'objet original (DateTime est mutable),
        // puis on fixe l'heure à 00:00:00 pour obtenir le tout début de la journée.
        $startOfDay = (clone $date)->setTime(0, 0, 0);

        // Idem, mais on fixe l'heure à 23:59:59 pour obtenir la toute fin de la journée.
        $endOfDay = (clone $date)->setTime(23, 59, 59);

        // On construit une requête Doctrine (QueryBuilder) sur l'entité Reservation,
        // avec "r" comme alias pour la table.
        return $this->createQueryBuilder('r')

            // Condition 1 : la réservation doit appartenir à l'utilisateur donné
            ->andWhere('r.user = :user')

            // Condition 2 : la date de la réservation doit être comprise
            // entre le début et la fin de la journée ciblée
            ->andWhere('r.date BETWEEN :start AND :end')

            // On lie les valeurs réelles aux paramètres nommés (:user, :start, :end)
            // pour éviter les injections SQL et que Doctrine génère la requête correctement
            ->setParameter('user', $user)
            ->setParameter('start', $startOfDay)
            ->setParameter('end', $endOfDay)

            // On transforme le QueryBuilder en objet Query exécutable
            ->getQuery()

            // On exécute la requête et on récupère :
            // - un seul résultat (Reservation) s'il y en a un
            // - null s'il n'y en a aucun
            // - lève une exception si jamais il y en a plusieurs (ce qui ne devrait
            //   normalement pas arriver si la règle "une réservation par jour" est respectée)
            ->getOneOrNullResult();
    }
}
