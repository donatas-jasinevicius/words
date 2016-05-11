<?php

namespace DoJa\Bundle\WordsStatisticsBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use DoJa\Component\FOSRest\Exception\ApiException;
use FOS\RestBundle\Controller\FOSRestController;
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
     * @Rest\View(serializerGroups={"main", "Default"})
     *
     * @param $id
     *
     * @return WordsListResults
     *
     * @throws ApiException
     */
    public function getWordsListResultsAction($id)
    {
        //todo: implement filter
        //todo check rights
        //todo: move to service?
        /** @var WordsList $wordsList */
        $wordsList = $this->wordsListRepository->find($id);

        if ($wordsList === null) {
            throw new ApiException(ApiException::NOT_FOUND);
        }
        $wordsResult = $this->wordResultRepository->findByWords($wordsList->getWords());

        $wordsListResult = new WordsListResults();
        $wordsListResult->setWordsList($wordsList);
        $wordsListResult->setWordsResults($wordsResult);

        return $wordsListResult;
    }

    /**
     * @Rest\View(serializerGroups={"main", "Default"})
     *
     * @return WordsListResults
     */
    public function addWordsListResultsAction(Request $request)
    {
        //todo check rights
        $wordsForm = $this->createForm(WordsListResultsFormType::class);

        $wordsForm->submit($request->request->all());

        $wordsListResults = $wordsForm->getData();
        if ($wordsForm->isValid()) {
            $this->wordsListResultsManager->saveWordsList($wordsListResults);
        } else {
            return $this->handleView($this->view($wordsForm));
        }

        $this->entityManager->flush();

        return $wordsListResults;
    }
}
