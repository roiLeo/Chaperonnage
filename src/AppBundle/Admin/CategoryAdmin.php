<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 19/04/2017
 * Time: 11:20
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Picture;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use AppBundle\Form\Type\ImageType;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class CategoryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->add('id')
            //->add('src')
            ->add('verified')
            ->add('uploadedFile', ImageType::class, ['image_web_path' => $this->getSubject()->getSrc()]);
        //->add('file', 'file', $fileFieldOptions);
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
            ->addIdentifier('verified');
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
        if ($picture->getUploadedFile() instanceof UploadedFile) {
            $this->getConfigurationPool()
                ->getContainer()
                ->get('app.picture_uploader')
                ->upload($picture);
        }
    }
}