<?php


namespace Kira\Validator;


interface ValidatorInterface
{
    /**
     * @param array $rules
     * @return mixed
     */
    public function setRules(array $rules);

    /**
     * @param array $input
     * @return mixed
     */
    public function validate(array $input);
}