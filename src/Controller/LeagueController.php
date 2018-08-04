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
            return new JsonResponse(['error'=>$exception->getMessage()], 400);
        }

        foreach ($teams as $team){
            $toNormalize[] = $team;
        }
        return new JsonResponse($teamNormalizer->bulkNormalize($toNormalize), 200);
    }

    public function teamCreate(League $league, Request $request, TeamService $teamService)
    {
        $data = json_decode($request->getContent(), true);
        try {
            $teamService->teamCreate($data, $league);
        } catch (Exception $exception) {

        }
        return new JsonResponse(['ok'], 201);

    }

    /**
     * @param Team $team
     * @param Request $request
     * @param TeamService $teamService
     * @param TeamNormalizer $teamNormalizer
     * @return JsonResponse
     */
    public function teamEdit(Team $team, Request $request, TeamService $teamService, TeamNormalizer $teamNormalizer)
    {
        $data = json_decode($request->getContent(), true);

        try {
            $editedTeam = $teamService->teamEdit($team, $data);
        } catch (Exception $exception) {
            return new JsonResponse(['error'=>$exception->getMessage()], 400);

        }
        return new JsonResponse($teamNormalizer->normalize($editedTeam), 200);
    }

}