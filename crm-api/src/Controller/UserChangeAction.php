<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\User\UserManager;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserChangeAction extends AbstractController
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHarsher
    ) {
    }

    public function __invoke(
        User $data,
        Request $request,
        UserManager $userManager,
        UserRepository $userRepository,
        ValidatorInterface $validator
    ): User
    {
        $userId = $request->query->get('id');
        $user = $userRepository->find($userId);
        $validator->validate($data);

        if (!$user) {
            throw new BadRequestHttpException('User not found');
        }

        if ($data->getPassword()) {
            $hashedPassword = $this->passwordHarsher->hashPassword($user, $data->getPassword());
            $user->setPassword($hashedPassword);
        }

        if ($data->getEmail()) {
            $user->setEmail($data->getEmail());
        }

        if ($data->getName()) {
            $user->setName($data->getName());
        }

        $userManager->save($user, true);

        return $user;
    }
}
