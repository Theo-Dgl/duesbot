<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Event;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadEventData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $club = $this->getReference('Bat Country East');

        $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget vestibulum risus. 
            Sed porta rutrum sodales. Mauris at volutpat risus, at aliquet risus. Proin rutrum libero aliquet augue 
            consectetur finibus. Integer euismod sagittis ex, at semper sapien. Aenean elementum, nisl ullamcorper 
            porttitor facilisis, mi dolor rutrum neque, non efficitur lectus sapien lobortis nisl. Donec porttitor 
            eros magna, ut cursus velit pulvinar in. Quisque auctor dui nunc, eget ultricies risus porttitor a. Mauris 
            dignissim nibh tellus, in porttitor diam feugiat in. Nam nulla ipsum, accumsan at congue quis, aliquet 
            non ante. In et iaculis dolor. Proin maximus venenatis lorem. Mauris eros neque, faucibus at massa non, 
            bibendum consequat augue. Pellentesque iaculis, purus vel tristique interdum, orci lacus faucibus tellus, 
            vel faucibus sem risus non tellus. Nullam eget convallis risus, a dictum justo."
        ;
        $kip = $this->getReference('member_Kip');
        $me = $this->getReference('member_Ollie');
        $brick = $this->getReference('member_Brick');

        $eventTraits = [
            [
                'name' => 'Haloween 2017',
                'description' => $description,
                'score' => 10,
                'total votes' => null,
                'date' => new \DateTime('2017-10-31'),
                'voting start' => new \DateTime('now'),
                'owner' => $me,
            ],
            [
                'name' => 'New Years Eve 2017',
                'description' => 'Lorem Ipsum Etcetera Etcetera. This is a short description.',
                'score' => 7,
                'total votes' => null,
                'date' => new \DateTime('2017-12-31'),
                'voting start' => new \DateTime('now'),
                'owner' => $kip,
            ],
            [
                'name' => 'Fly in a friend',
                'description' => $description.'<br /><br />'.$description,
                'score' => 16,
                'total votes' => null,
                'date' => new \DateTime('2017-11-15'),
                'voting start' => new \DateTime('now'),
                'owner' => $brick,
            ],
        ];

        foreach ($eventTraits as $eventTrait) {
            $event = new Event();
            $event
                ->setName($eventTrait['name'])
                ->setDescription($eventTrait['description'])
                ->setDate($eventTrait['date'])
                ->setVotingStart($eventTrait['voting start'])
                ->setClub($club)
                ->setOwner($eventTrait['owner'])
            ;
            $event
                ->setTime($event->getDate()->setTime(14, 55))
                ->setVotingEnd($event->getDate()->modify('-1 week'))
            ;

            $this->addReference($eventTrait['name'], $event);
            $manager->persist($event);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 3;
    }
}
