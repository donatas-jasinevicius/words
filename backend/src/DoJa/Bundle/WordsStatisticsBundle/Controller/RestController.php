<?php

namespace DoJa\Bundle\WordsStatisticsBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use DoJa\Component\FOSRest\Exception\ApiException;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use DoJa\Bundle\WordsBundle\Entity\WordsList;
use DoJa\Bundle\WordsBundle\Service\WordsListManager;
use DoJa\Bundle\WordsStatisticsBundle\Entity\WordsListResults;
use DoJa\Bundle\WordsStatisticsBundle\Form\WordsListResultsFormType;
use DoJa\Bundle\WordsStatisticsBundle\Repository\WordResultRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use DoJa\Bundle\WordsStatisticsBundle\Service\WordsListResultsManager;

class RestController extends FOSRestController
{
    private $wordsListManager;
    private $wordsListResultsManager;
    private $wordsListRepository;
    private $wordResultRepository;
    private $serializer;
    private $entityManager;

    public function __construct(
        WordsListManager $wordsListManager,
        WordsListResultsManager $wordsListResultsManager,
        EntityRepository $wordsListRepository,
        WordResultRepository $wordResultRepository,
        Serializer $serializer,
        EntityManager $entityManager
    ) {
        $this->wordsListManager = $wordsListManager;
        $this->wordsListResultsManager = $wordsListResultsManager;
        $this->wordsListRepository = $wordsListRepository;
        $this->wordResultRepository = $wordResultRepository;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    /**
     * todo: implement filter param
     * @param $id
     *
     * @return WordsListResults
     *
     * @throws ApiException
     */
    public function getWordsListResultsAction($id)
    {
        /** @var WordsList $wordsList */
        $wordsList = $this->wordsListRepository->find($id);

        if ($wordsList === null) {
            throw new ApiException(ApiException::NOT_FOUND);
        }
        $wordsResults = $this->wordResultRepository->findByWords($wordsList->getWords());

        $wordsListResults = new WordsListResults();
        $wordsListResults->setWordsList($wordsList);
        $wordsListResults->setWordsResults($wordsResults);

        return $this->handleView(
            $this
                ->view($wordsListResults)
                ->setSerializationContext(SerializationContext::create()->setGroups(array('main', 'Default')))
        );
    }

    /**
     * @param Request $request
     *
     * @return WordsListResults
     */
    public function addWordsListResultsAction(Request $request)
    {
        $wordsForm = $this->createForm(WordsListResultsFormType::class);

        $wordsForm->submit($request->request->all());

        $wordsListResults = $wordsForm->getData();
        if ($wordsForm->isValid()) {
            $this->wordsListResultsManager->saveWordsList($wordsListResults);
        } else {
            return $this->handleView($this->view($wordsForm));
        }

        $this->entityManager->flush();


        return $this->handleView(
            $this
                ->view($wordsListResults)
                ->setSerializationContext(SerializationContext::create()->setGroups(array('main', 'Default')))
        );
    }
}
