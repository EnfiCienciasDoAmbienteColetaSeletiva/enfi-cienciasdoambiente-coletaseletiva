<?php

namespace Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Entity\TipoDeLixo;
use Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Form\TipoDeLixoType;

/**
 * TipoDeLixo controller.
 *
 * @Route("/manage/tipodelixo")
 */
class TipoDeLixoController extends Controller
{

    /**
     * Lists all TipoDeLixo entities.
     *
     * @Route("/", name="manage_tipodelixo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:TipoDeLixo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TipoDeLixo entity.
     *
     * @Route("/", name="manage_tipodelixo_create")
     * @Method("POST")
     * @Template("EnfiCienciasDoAmbienteCommonEntitiesBundle:TipoDeLixo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoDeLixo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manage_tipodelixo_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoDeLixo entity.
     *
     * @param TipoDeLixo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoDeLixo $entity)
    {
        $form = $this->createForm(new TipoDeLixoType(), $entity, array(
            'action' => $this->generateUrl('manage_tipodelixo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Inserir'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoDeLixo entity.
     *
     * @Route("/new", name="manage_tipodelixo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoDeLixo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoDeLixo entity.
     *
     * @Route("/{id}", name="manage_tipodelixo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:TipoDeLixo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDeLixo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoDeLixo entity.
     *
     * @Route("/{id}/edit", name="manage_tipodelixo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:TipoDeLixo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDeLixo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a TipoDeLixo entity.
    *
    * @param TipoDeLixo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoDeLixo $entity)
    {
        $form = $this->createForm(new TipoDeLixoType(), $entity, array(
            'action' => $this->generateUrl('manage_tipodelixo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Alterar'));

        return $form;
    }
    /**
     * Edits an existing TipoDeLixo entity.
     *
     * @Route("/{id}", name="manage_tipodelixo_update")
     * @Method("PUT")
     * @Template("EnfiCienciasDoAmbienteCommonEntitiesBundle:TipoDeLixo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:TipoDeLixo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoDeLixo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('manage_tipodelixo_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TipoDeLixo entity.
     *
     * @Route("/{id}", name="manage_tipodelixo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:TipoDeLixo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoDeLixo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('manage_tipodelixo'));
    }

    /**
     * Creates a form to delete a TipoDeLixo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('manage_tipodelixo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir'))
            ->getForm()
        ;
    }
}
