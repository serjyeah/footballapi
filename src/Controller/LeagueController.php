<?php
/**
 * Created by PhpStorm.
 * User: serj
 * Date: 8/4/18
 * Time: 12:23 PM
 */

namespace App\Controller;


use App\Entity\League;
use App\Entity\Team;
use App\Services\TeamNormalizer;
use App\Services\TeamService;
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

    public function teamCreate(League $league, Request $request, TeamService $teamService)
    {
        $data = $request->request->all();
        try {
            $teamService->teamCreate($data, $league);
        } catch (Exception $exception) {

        }
        return new JsonResponse(['ok'], 201);

    }

}