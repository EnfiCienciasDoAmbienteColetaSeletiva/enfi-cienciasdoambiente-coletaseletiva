<?php

namespace Enfi\CienciasDoAmbiente\CommonEntitiesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;

class UtilController extends Controller
{
    /**
     * @Template()
     */
    public function gitVersionAction()
    {
        $git_version = file_get_contents($this->container->getParameter('kernel.root_dir') . '/../github_hook/git-current-commit.txt');
        return array('git_version' => $git_version);
    }
}
