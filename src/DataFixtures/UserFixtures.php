<?php
/**
 * @author iuli dercaci
 * 27/07/18 11:08
 */

namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $encoded = $this->encoder->encodePassword($user, 'test_password');
        $user->setUsername('test_user')
            ->setPassword($encoded)
            ->setEmail('test.user@mail.com')
            ->setIsActive(true);

        $manager->persist($user);
        $manager->flush();
    }
}
