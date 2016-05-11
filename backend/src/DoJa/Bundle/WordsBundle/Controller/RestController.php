<?php

namespace DoJa\Bundle\WordsBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use DoJa\Component\FOSRest\Exception\ApiException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use DoJa\Bundle\WordsBundle\Entity\WordsList;
use DoJa\Bundle\WordsBundle\Form\WordsListFormType;
use DoJa\Bundle\WordsBundle\Service\WordsListManager;

class RestController extends FOSRestController
{
    private $wordsListManager;
    private $wordsListRepository;
    private $entityManager;

    public function __construct(
        WordsListManager $wordsListManager,
        EntityRepository $wordsListRepository,
        EntityManager $entityManager
    ) {
        $this->wordsListManager = $wordsListManager;
        $this->wordsListRepository = $wordsListRepository;
        $this->entityManager = $entityManager;
    }

    public function getAllWordsAction(Request $request)
    {
        //todo check rights
        $wordsLists = $this->wordsListRepository->findAll();

        return $this->handleView($this->view($wordsLists, 200));
    }

    public function getWordsAction(Request $request, $id)
    {
        //todo check rights
        $wordsList = $this->wordsListRepository->find($id);

        if ($wordsList === null) {
            throw new ApiException(ApiException::NOT_FOUND);
        }

        return $this->handleView($this->view($wordsList, 200));
    }

    public function addWordsAction(Request $request)
    {
        //todo check rights
        //todo: error when trying to save empty translation
        $wordsForm = $this->createForm(WordsListFormType::class);

        $wordsForm->submit($request->request->all());

        $wordsList = $wordsForm->getData();
        if ($wordsForm->isValid()) {
            $this->wordsListManager->saveWordsList($wordsList);
        } else {
            return $this->handleView($this->view($wordsForm));
        }

        $this->entityManager->flush();

        return $this->handleView($this->view($wordsList, Codes::HTTP_CREATED));
    }

    public function editWordsAction(Request $request, $id)
    {
        //todo check rights
        $wordsList = $this->wordsListRepository->find($id);

        if ($wordsList === null) {
            throw new ApiException(ApiException::NOT_FOUND);
        }

        $wordsForm = $this->createForm(WordsListFormType::class, $wordsList);

        $wordsForm->submit($request->request->all());

        $wordsList = $wordsForm->getData();
        if ($wordsForm->isValid()) {
            $this->wordsListManager->saveWordsList($wordsList);
        } else {
            return $this->handleView($this->view($wordsForm));
        }

        $this->entityManager->flush();

        return $this->handleView($this->view($wordsList, Codes::HTTP_OK));
    }

    public function deleteWordsAction($id)
    {
        //todo check rights
        //todo: anotation on methods and variables
        /** @var WordsList $wordsList */
        $wordsList = $this->wordsListRepository->find($id);

        if ($wordsList === null) {
            throw new ApiException(ApiException::NOT_FOUND);
        }

        $this->wordsListManager->deleteWordsList($wordsList);
        $this->entityManager->flush();

        return $this->handleView($this->view(null, Codes::HTTP_NO_CONTENT));
    }
}