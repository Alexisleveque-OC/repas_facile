<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use \App\Entity\Product;

class ProductVoter extends Voter
{
    const PRODUCT_LIST   = 'PRODUCT_LIST';
    const PRODUCT_CREATE = 'PRODUCT_CREATE';
    const PRODUCT_EDIT   = 'PRODUCT_EDIT';
    const PRODUCT_DELETE = 'PRODUCT_DELETE';

    /**
     * @var Security
     */
    public $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports(string $attribute, $subject): bool
    {
        return in_array($attribute, ['PRODUCT_CREATE', 'PRODUCT_LIST']) ||
            in_array($attribute, ['PRODUCT_EDIT', 'PRODUCT_DELETE'])
            && $subject instanceof Product;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        $isConnected = $user instanceof UserInterface;

        switch ($attribute) {
            case 'PRODUCT_LIST':
            case 'PRODUCT_CREATE':
            case 'PRODUCT_EDIT':
                return $isConnected && $this->security->isGranted("ROLE_USER");
                break;
            case 'PRODUCT_DELETE':
                return $isConnected && $this->security->isGranted("ROLE_ADMIN");
                break;
        }

        return false;
    }
}
