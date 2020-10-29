<?php


namespace Kira\Validator;

use Rakit\Validation\Validator as ValidatorAdapter;

class Validator implements ValidatorInterface
{
    /**
     * @var \Rakit\Validation\Validator
     */
    protected $validator;

    /**
     * @var array
     */
    protected $rules;

    public function __construct()
    {
        $this->validator = new ValidatorAdapter();
    }

    /**
     * @param array $rules
     * @return $this
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * @param array $input
     * @return bool
     * @throws \Exception
     */
    public function validate(array $input)
    {
        if (!$this->rules) {
            throw new \InvalidArgumentException('No rules to process.');
        }

        $validation = $this->validator->make($input, $this->rules);
        $validation->validate();

        if ($validation->fails()) {
            throw new \Exception(json_encode($validation->errors()->firstOfAll()));
        }

        return true;
    }
}