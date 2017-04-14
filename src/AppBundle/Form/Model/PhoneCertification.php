<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class PhoneCertification
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 4,
     *      max = 4,
     *      minMessage = "Le code ne doit pas faire moins de {{ limit }} caractères",
     *      maxMessage = "Le code ne doit pas dépasser {{ limit }} caractères"
     * )
     */
    private $code;

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return PhoneCertification
     */
    public function setCode(string $code): PhoneCertification
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        if ('0000' !== $this->getCode()) {
            $context->buildViolation('Le code saisi est invalide !')
                ->addViolation();
        }
    }
}
