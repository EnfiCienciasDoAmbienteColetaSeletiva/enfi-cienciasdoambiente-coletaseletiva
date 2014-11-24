<?php

namespace Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Entity\PontoDeColeta;
use Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Form\PontoDeColetaType;

/**
 * PontoDeColeta controller.
 *
 * @Route("/manage/pontodecoleta")
 */
class PontoDeColetaController extends Controller
{

    /**
     * Lists all PontoDeColeta entities.
     *
     * @Route("/", name="manage_pontodecoleta")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:PontoDeColeta')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new PontoDeColeta entity.
     *
     * @Route("/", name="manage_pontodecoleta_create")
     * @Method("POST")
     * @Template("EnfiCienciasDoAmbienteCommonEntitiesBundle:PontoDeColeta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PontoDeColeta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            // Load pontos de coleta
            $repository = $this->getDoctrine()
                ->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:PontoDeColeta');

            $idFixo = $repository->getMaxIdFixo()+1;
            $entity->setIdFixo($idFixo);
            $entity->setRevision($repository->getMaxRevision($idFixo)+1);
            $entity->setAtivo(1);
            $entity->setUsuarioId(1);
            $entity->setTimestamp(new \DateTime('now'));
            $entity->setDescricaoDasModificacoes('Novo registro.');

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manage_pontodecoleta_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PontoDeColeta entity.
     *
     * @param PontoDeColeta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PontoDeColeta $entity)
    {
        $form = $this->createForm(new PontoDeColetaType(), $entity, array(
            'action' => $this->generateUrl('manage_pontodecoleta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Inserir'));

        return $form;
    }

    /**
     * Displays a form to create a new PontoDeColeta entity.
     *
     * @Route("/new", name="manage_pontodecoleta_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PontoDeColeta();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PontoDeColeta entity.
     *
     * @Route("/{id}", name="manage_pontodecoleta_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:PontoDeColeta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PontoDeColeta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PontoDeColeta entity.
     *
     * @Route("/{id}/edit", name="manage_pontodecoleta_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:PontoDeColeta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PontoDeColeta entity.');
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
    * Creates a form to edit a PontoDeColeta entity.
    *
    * @param PontoDeColeta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PontoDeColeta $entity)
    {
        $form = $this->createForm(new PontoDeColetaType(), $entity, array(
            'action' => $this->generateUrl('manage_pontodecoleta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Alterar'));

        return $form;
    }
    /**
     * Edits an existing PontoDeColeta entity.
     *
     * @Route("/{id}", name="manage_pontodecoleta_update")
     * @Method("PUT")
     * @Template("EnfiCienciasDoAmbienteCommonEntitiesBundle:PontoDeColeta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:PontoDeColeta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PontoDeColeta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('manage_pontodecoleta_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a PontoDeColeta entity.
     *
     * @Route("/{id}", name="manage_pontodecoleta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfiCienciasDoAmbienteCommonEntitiesBundle:PontoDeColeta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PontoDeColeta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('manage_pontodecoleta'));
    }

    /**
     * Creates a form to delete a PontoDeColeta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('manage_pontodecoleta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Excluir'))
            ->getForm()
        ;
    }
}
