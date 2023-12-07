<?php
class Validation
{
    protected array $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function validate(array $validations): bool
    {
        $rule = new Rule($this->request);
        return $rule->validate($validations);
    }

    protected $messages = [
        'required' => "The :attr field is required.",
        'email' => "The :attr field should be a valid email address.",
        'number' => "The :attr field should be a number.",
        'image' => "The :attr field should be a valid image.",
        'max' => 'The :attr field should not be greater than :value characters.',
        'min' => 'The :attr field should not be less than :value characters.',
        'in' => 'The :attr field is invalid.',
        'alpha_dash' => 'The :attr can only contain alpha-numeric, underscores and dashes.',
        'exists' => 'The :attr field doesn\'t exists.',
        'unique' => 'The :attr field is already taken.'
    ];
}
