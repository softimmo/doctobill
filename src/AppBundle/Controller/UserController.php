<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Form\UserPasswordType;
use AppBundle\Form\UserNameType;
use AppBundle\Form\UserRoleType;
use AppBundle\Entity\UserRole;


use BackEndBundle\Entity\VedimCompany;

/**
 * VedimDossier controller.
 *
 * @Route("/{_locale}/user", requirements={"_locale": "fr|en|it"})
 */
class UserController extends Controller {

        /**
     * Lists all company entities.
     *
     * @Route("/", name="user_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $companies = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('user/index.html.twig', array(
            'companies' => $companies,
        ));
    }

    /**
     * Change password
     *
     * @Route("/{id}/changePassword", name="changePassword")
     * @Method({"GET","POST"})
     * @Template("user/change.password.html.twig")
     */
    public function changePasswordAction(Request $request, User $user) {
        $this->get('company_manager')->controleAccesEntity($user);
        $logger = $this->get('logger');
        $user_createur = $this->getUser();
        $logger->info($user_createur . ' changePasswordAction user n°' . $user->getId() . ' par user_createur n° ' . $user_createur->getId());

        $formPassword = $this->createForm(UserPasswordType::class, $user);
        $formPassword->handleRequest($request);

        if ($formPassword->isSubmitted() && $formPassword->isValid()) {
            $logger->info($user_createur . ' changePasswordAction soummission formlogin changement login ' . $user->getUsername());
            $encoder = $this->container->get('security.encoder_factory')->getEncoder($user);
            $newPasswordEncoded = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($newPasswordEncoded);
            $this->getDoctrine()->getManager()->flush();
        }
        $formUserName = $this->createForm(UserNameType::class, $user);
        $formUserName->handleRequest($request);
        if ($formUserName->isSubmitted() && $formUserName->isValid()) {
            $logger->info($user_createur . ' changePasswordAction soummission formlogin changement login ' . $user->getUsername());
            $this->getDoctrine()->getManager()->flush();
        }
        return array(
            'user' => $user,
            'formPassword' => $formPassword->createView(),
            'formUserName' => $formUserName->createView(),
        );
    }

    /**
     * regenere le password via AJAX
     * @Route("/{id}/regeneratePassword", name="ajax_regenerate_password")
     * @Method("POST")
     */
    public function regeneratePasswordAction(Request $request, $id) {
        if ($request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();
            $logger = $this->get('logger');
            $user_createur = $this->getUser();
            $affiliate_createur = $user_createur->getAffiliate();

            $userManager = $this->get('fos_user.user_manager');
            $tokenGenerator = $this->container->get('fos_user.util.token_generator');
            $newPassword = substr($tokenGenerator->generateToken(), 0, 8);
            $user = $this->get('model_manager')->find($id, 'AppBundle:User');
            $vedimUser = $user->getVedimUser();
            $vedimUser->setPlainPassword($newPassword);
            $userManager->updatePassword($vedimUser);
            $em->persist($vedimUser);
            $em->flush();
            $affiliate = $user->getAffiliate();
//            $this->get('company_manager')->controleAccesEntity($user->getAffiliate());
            $this->get('mail_manager')->sendMailChangePassword($affiliate, $newPassword);
            $message = $this->get('translator')->trans('Un nouveau Password "%password%" a ete pris en compte pour le login "%login%" de %affiliate%', array('%password%' => $newPassword, '%login%' => $user->getUsername(), '%affiliate%' => $affiliate->getNomCourt()));
            $this->get('session')->getFlashBag()->add('notice', $message);
            $logger->info($user_createur . ' updatePasswordAction affiliate ' . $affiliate->getIdentification() . ' avant envoi formulaire');
            return new Response($message);
        }
        return new Response('KO');
    }

    /**
     * Displays a form to edit les roles des user.
     *
     * @Route("/edit_roles/{id}", name="roles_edit")
     * @Method({"POST","GET"})     * 
     */
    public function editRolesAction(Request $request, User $user) {
        $logger = $this->get('logger');
        $user_createur = $this->getUser();
        $affiliate = $user->getAffiliate();
        $this->get('company_manager')->controleAccesEntity($affiliate);
        $em = $this->getDoctrine()->getManager();
 
        $user_role = new UserRole();
        $editForm = $this->createForm(UserRoleType::class, $user_role, ['user' => $user]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted()) {
            if ($editForm->isValid()) {
                $user->removeAllRoles();
                foreach ($user_role->getRoles() as $role) {
                    $logger->info($user_createur . ' updateRoleAction ajout pour ' . $user->getId() . ' role=' . $role);
                    $user->addRole($role);
                }
                $message = $this->get('translator')->trans('Save ok');
                $this->get('session')->getFlashBag()->add('notice', $message);
                $em->persist($user);
                $em->flush();

                return $this->redirect($this->generateUrl('roles_edit', array('id' => $user->getId())));
            } else {
                $logger->info('formulaireInvalid.....' . $editForm->getErrorsAsString());
            }
        } else {
            foreach ($user->getRoles() as $role) {
                $logger->info($user_createur . ' editRolesAction pour ' . $user->getId() . ' role=' . $role);
                $user_role->addRole($role);
            }
            $editForm = $this->createForm(UserRoleType::class, $user_role, ['user' => $user]);
        }

        return $this->render('user/edit_roles.html.twig', array(
                    'form' => $editForm->createView(),
                    'affiliate' => $affiliate
        ));
    }

    /**
     * Edits an existing VedimPatient entity.
     *
     * @Route("/update_roles/{id}", name="roles_update")
     * @Method("POST")
     */
    public function updateRoleAction(Request $request, User $user) {
        $logger = $this->get('logger');
        $user_createur = $this->getUser();
        $user_role = new UserRole();
        $editForm = $this->createForm(UserRoleType::class, $user_role, ['user' => $user_createur]);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->removeAllRoles();
            foreach ($user_role->getRoles() as $role) {
                $logger->info($user_createur . ' updateRoleAction ajout pour ' . $user->getId() . ' role=' . $role);
                $user->addRole($role);
            }
            $message = $this->get('translator')->trans('Save ok');
            $this->get('session')->getFlashBag()->add('notice', $message);
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('roles_edit', array('id' => $id)));
        } else {
            $logger->info('formulaireInvalid.....' . $editForm->getErrorsAsString());
        }
        $affiliate = $user->getAffiliate();
        return $this->render('user/edit_roles.html.twig', array(
                    'form' => $editForm->createView(),
                    'affiliate' => $affiliate
        ));
    }

    /**
     * @Route("/{id}/whoIsOnline", name="whoIsOnline")
     * @Template("user/whoIsOnline.html.twig")
     */
    public function whoIsOnlineAction(Request $request, VedimCompany $company) {
        $users = $this->getDoctrine()->getManager()->getRepository('AppBundle:User')->getActive($company->getId());
        
        return array('users' => $users, 'company' => $company);
    }

}
