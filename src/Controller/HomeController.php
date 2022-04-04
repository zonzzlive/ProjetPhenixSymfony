<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;
use App\Repository\PortfolioRepository;
use App\Repository\TeamMembreRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(ProjectRepository $projectRepository, PortfolioRepository $portfolioRepository, TeamMembreRepository $teamMembreRepository): Response
    {
        if (!$this->getUser()){
            return $this->redirectToRoute('app_register');
        }
        $datArray = [
            'controller_name' => 'HomeController',
            $user = $this->getUser(),
            $idUser = $user->getId(),
            'portfolios' => $portfolioRepository->findBy(["user" => $idUser]),
            $idPortfolio = $user->getPortfolio()->getId(),
            'projects' => $projectRepository->findBy(["portfolio" => $idPortfolio]),
            $teamMembre = $teamMembreRepository->findBy(["user" => $idUser]),
            'teamProjects' => [],
            'teamCustomers' => [],
        ];
        if ($teamMembre != null) {
            for ($x = 0; $x < count($teamMembre); $x++) {
                array_push($datArray['teamProjects'], $projectRepository->findBy(["teamProject" => $teamMembre[$x]->getTeam()]));
                array_push($datArray['teamCustomers'], $projectRepository->findBy(["clientTeam" => $teamMembre[$x]->getTeam()]));
            }
        }
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('home/index.html.twig', $datArray);
    }

    public function ifTeamMembreTrue(ProjectRepository $projectRepository,){

        return;
    }

}
