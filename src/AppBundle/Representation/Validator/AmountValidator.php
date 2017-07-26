<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 24.07.17
 * Time: 20:51
 */

namespace AppBundle\Representation\Validator;


use Symfony\Component\Validator\Context\ExecutionContextInterface;

class AmountValidator
{
    /**
     * @param $object
     * @param ExecutionContextInterface $context
     */
    public static function validate($object, ExecutionContextInterface $context)
    {
        if (!preg_match('/^\d{1,10}.\d{2}$/', $object)) {
            $context->buildViolation('Incorrect amount format, should contain from 10 to 1 characters to the point and 2 characters after the point.')
                ->atPath('amount')
                ->addViolation();
        }
    }
}