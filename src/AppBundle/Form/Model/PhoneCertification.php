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

class PhoneCertification
{
    /**
     * @var string
     * @Assert\NotBlank()
     *  @Assert\EqualTo("0000")
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
}
