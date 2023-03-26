<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validation;
use DateTime;

class User {
    private DateTime $created_at;

    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $password
    ) {
        $this->created_at = new DateTime();

        // Validate object using Symfony Validator
        $validator = Validation::createValidator();
        $violations = $validator->validate($this);

        if (count($violations) > 0) {
            // Throw exception if validation fails
            echo "exeption";
        }
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getName() {
        return $this->name;
    }

	public function setCreated_at(DateTime $created_at): self {
		$this->created_at = $created_at;
		return $this;
	}

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint(
            'id',
            new Assert\NotBlank(
                array(
                    'message' => 'Enter the ID'
                )
            )
        );
        $metadata->addPropertyConstraint(
            'id',
            new Assert\Positive(
                array(
                    'message' => 'ID should be > 0'
                )
            )
        );
        $metadata->addPropertyConstraint(
            'name',
            new Assert\Length(
                array(
                    'min' => 3,
                    'max' => 20,
                    'minMessage' => 'Name length should be > 3 ',
                    'maxMessage' => 'Name length should be < 20',
                )
            )
        );
        $metadata->addPropertyConstraint(
            'email',
            new Assert\Email(
                array(
                    'message' => 'The email "{{ value }}" is not a valid email.',
                )
            )
        );
        $metadata->addPropertyConstraint(
            'password',
            new Assert\NotBlank(
                array(
                    'message' => 'Enter the Password',
                )
            )
        );
        $metadata->addPropertyConstraint(
            'password',
            new Assert\Length(
                array(
                    'min' => 5,
                    'max' => 20,
                    'minMessage' => 'Password length should be > 5',
                    'maxMessage' => 'Password length should be < 20',
                )
            )
        );
    }
}