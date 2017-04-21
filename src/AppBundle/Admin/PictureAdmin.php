<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Picture;
use AppBundle\Form\Type\ImageType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('verified')
            ->add('uploadedFile', ImageType::class, ['image_web_path' => $this->getSubject()->getSrc()])
            ->add('picture_type','text');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('src')
            ->addIdentifier('verified')
            ->add('picture_type');
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        $this->upload($object);
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        $this->upload($object);
    }

    private function upload(Picture $picture)
    {
        $pictureUploader = $this
            ->getConfigurationPool()
            ->getContainer()
            ->get('app.picture_uploader');

        if ($picture->getUploadedFile() instanceof UploadedFile) {
            if ($picture->isAvatar()) {
                $pictureUploader
                    ->uploadAvatar($picture);
            } elseif ($picture->isCredential()) {
                $pictureUploader
                    ->uploadCredential($picture);
            }
        }
    }
}
