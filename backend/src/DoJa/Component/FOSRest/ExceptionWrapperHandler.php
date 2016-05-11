<?php

namespace DoJa\Component\FOSRest;

use DoJa\Component\FOSRest\Exception\ApiException;
use FOS\RestBundle\View\ExceptionWrapperHandlerInterface;
use Symfony\Component\Form\Form;

class ExceptionWrapperHandler implements ExceptionWrapperHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function wrap($data)
    {
        if ($data['errors'] instanceof Form) {
            $data['status_text'] = ApiException::INVALID_PARAMETERS;
            $form = $data['errors'];
            $data['errors'] = [];

            foreach ($form->getErrors(true, true) as $error) {
                $path = $error->getCause()->getPropertyPath();
                $data['errors'][$path] = $error->getMessage();
            }
        }

        return new ExceptionWrapper($data);
    }
}
