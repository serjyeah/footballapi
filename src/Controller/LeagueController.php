<?php
/**
 * Created by PhpStorm.
 * User: serj
 * Date: 8/4/18
 * Time: 12:23 PM
 */

namespace App\Controller;


use App\Entity\League;
use App\Services\TeamNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LeagueController extends AbstractController
{

    /**
     * @param League $league
     * @param TeamNormalizer $teamNormalizer
     * @return JsonResponse
     */
    public function leagueTeams(League $league, TeamNormalizer $teamNormalizer)
    {
        try {
            $teams = $league->getTeams();
        } catch (Exception $exception) {
            //Process exception in a nice way
        }

        foreach ($teams as $team){
            $toNormalize[] = $team;
        }
        return new JsonResponse($teamNormalizer->bulkNormalize($toNormalize), 200);
    }

}