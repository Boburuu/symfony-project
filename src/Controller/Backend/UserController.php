<?php

namespace App\Controller\Backend;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/user')]
class UserController extends AbstractController
{

    //Ont instancie la class UserRepository , ont stock donc l'instance de cette class
    public function __construct(private UserRepository $repoUser)
    {
    }
    //Le UserRepositor récupère tout (repository = récupérer)
    #[Route('', name: 'admin.user.index')]
    public function indexUser(): Response
    {
        //Ont recupere l'instance $repoUser ce qui récupère tout les user en bdd
        $users = $this->repoUser->findAll();

        return $this->render('Backend/User/index.html.twig', [
            'users' => $users
        ]);
    }

        #[Route('/{id}/edit', name: 'admin.user.edit')]
        public function editUser(?User $user, Request $request): Response|RedirectResponse
        {
            //Si l'id n'est pas bon
            if (!$user instanceof User) {
                $this->addFlash('error', "User not found");

                return $this->redirectToRoute('admin.index.user');
            }
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            //verification de la validité du formulaire ainsi que si il est soumis 
            if($form->isSubmitted() && $form->isValid()){
                //Envoie la modification du user en bdd
                $this->repoUser->add($user, true);
                //On ajoute un message de succés
                $this->addFlash("success", 'User edit with success');

                return $this->redirectToRoute('admin.user.index');
            }

            return $this->renderForm('Backend/User/edit.html.twig',[
                'form'=> $form,
                'user'=> $user,
            ]);
        }






    
    #[Route('/{id}/delete', name: 'admin.user.delete', methods: ['POST'])]
    public function deleteUser(?User $user, Request $request): RedirectResponse
    {
        if (!$user instanceof User) {
            $this->addFlash('error', "User not found");

            return $this->redirectToRoute('admin.user.index');
        }
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->get('_token'))) {
            $this->repoUser->remove($user, true);

            $this->addFlash('succsee', 'User supprimer avec brio');

            return $this->redirectToRoute('admin.user.index');
        }
    }
}
