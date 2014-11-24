<?php

namespace Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Entity\AvaliacaoDoPontoDeColeta;
use Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Form\AvaliacaoDoPontoDeColetaType;

/**
 * AvaliacaoDoPontoDeColeta controller.
 *
 * @Route("/manage/avaliacaodopontodecoleta")
 */
class AvaliacaoDoPontoDeColetaController extends Controller
{

    /**
     * Lists all AvaliacaoDoPontoDeColeta entities.
     *
     * @Route("/", name="manage_avaliacaodopontodecoleta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:AvaliacaoDoPontoDeColeta')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new AvaliacaoDoPontoDeColeta entity.
     *
     * @Route("/", name="manage_avaliacaodopontodecoleta_create")
     * @Method("POST")
     * @Template("EnfiCienciasDoAmbienteCommonEntitiesBundle:AvaliacaoDoPontoDeColeta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new AvaliacaoDoPontoDeColeta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manage_avaliacaodopontodecoleta_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a AvaliacaoDoPontoDeColeta entity.
     *
     * @param AvaliacaoDoPontoDeColeta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(AvaliacaoDoPontoDeColeta $entity)
    {
        $form = $this->createForm(new AvaliacaoDoPontoDeColetaType(), $entity, array(
            'action' => $this->generateUrl('manage_avaliacaodopontodecoleta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Inserir'));

        return $form;
    }

    /**
     * Displays a form to create a new AvaliacaoDoPontoDeColeta entity.
     *
     * @Route("/new", name="manage_avaliacaodopontodecoleta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new AvaliacaoDoPontoDeColeta();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a AvaliacaoDoPontoDeColeta entity.
     *
     * @Route("/{id}", name="manage_avaliacaodopontodecoleta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:AvaliacaoDoPontoDeColeta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AvaliacaoDoPontoDeColeta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing AvaliacaoDoPontoDeColeta entity.
     *
     * @Route("/{id}/edit", name="manage_avaliacaodopontodecoleta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:AvaliacaoDoPontoDeColeta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AvaliacaoDoPontoDeColeta entity.');
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
    * Creates a form to edit a AvaliacaoDoPontoDeColeta entity.
    *
    * @param AvaliacaoDoPontoDeColeta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AvaliacaoDoPontoDeColeta $entity)
    {
        $form = $this->createForm(new AvaliacaoDoPontoDeColetaType(), $entity, array(
            'action' => $this->generateUrl('manage_avaliacaodopontodecoleta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Alterar'));

        return $form;
    }
    /**
     * Edits an existing AvaliacaoDoPontoDeColeta entity.
     *
     * @Route("/{id}", name="manage_avaliacaodopontodecoleta_update")
     * @Method("PUT")
     * @Template("EnfiCienciasDoAmbienteCommonEntitiesBundle:AvaliacaoDoPontoDeColeta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:AvaliacaoDoPontoDeColeta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AvaliacaoDoPontoDeColeta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('manage_avaliacaodopontodecoleta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a AvaliacaoDoPontoDeColeta entity.
     *
     * @Route("/{id}", name="manage_avaliacaodopontodecoleta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:AvaliacaoDoPontoDeColeta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AvaliacaoDoPontoDeColeta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('manage_avaliacaodopontodecoleta'));
    }

    /**
     * Creates a form to delete a AvaliacaoDoPontoDeColeta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('manage_avaliacaodopontodecoleta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir'))
            ->getForm()
        ;
    }
}
