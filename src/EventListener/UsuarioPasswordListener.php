<?php

namespace App\EventListener;

use App\Entity\Usuario;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsuarioPasswordListener
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    /**
     * Evento que se ejecuta antes de persistir un nuevo usuario.
     */
    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Usuario) {
            return;
        }

        $this->encodePassword($entity);
    }

    /**
     * Evento que se ejecuta antes de actualizar un usuario.
     */
    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Usuario) {
            return;
        }

        $this->encodePassword($entity);

        // Forzar que Doctrine detecte el cambio en la entidad
        $em = $args->getObjectManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    /**
     * Encripta la contraseña del usuario si no está encriptada.
     */
    private function encodePassword(Usuario $usuario): void
    {
        if ($usuario->getPassword() && !$this->isPasswordHashed($usuario->getPassword())) {
            $hashedPassword = $this->passwordHasher->hashPassword(
                $usuario,
                $usuario->getPassword()
            );
            $usuario->setPassword($hashedPassword);
        }
    }

    /**
     * Verifica si una contraseña ya está encriptada.
     */
    private function isPasswordHashed(string $password): bool
    {
        return preg_match('/^\$2[ayb]\$.{56}$/', $password) === 1;
    }
}


