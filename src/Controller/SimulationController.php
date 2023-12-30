<?php

namespace App\Controller;

use App\Enum\Rune;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SimulationController extends AbstractController
{
    #[Route('/simulation', name: 'simulation')]
    public function index(): Response
    {
        return $this->render('simulation/index.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
        ]);
    }

    #[Route('/simulation/rune', name: 'rune_simulation')]
    public function rune(Request $request): Response
    {


        /* INITIATING DEFAULT VALUES */


        $default = [];

        $default['type'] = Rune\Type::RAGE;
        $default['rank'] = Rune\Rank::STAR_6;
        $default['rarity'] = Rune\Rarity::LEGEND;
        $default['level'] = 9;
        $default['fst_growth_rank'] = Rune\GrowthRank::S;
        $default['snd_growth_rank'] = Rune\GrowthRank::S;
        $default['thr_growth_rank'] = Rune\GrowthRank::S;


        /* RETRIEVING GOT VALUES */


        if ($request->query->get('type') !== NULL)
        {
            $default['type'] = Rune\Type::tryFrom($request->query->get('type')) ?? $default['type'];
        }
        if ($request->query->get('rank') !== NULL)
        {
            $default['rank'] = Rune\Rank::tryFrom($request->query->get('rank')) ?? $default['rank'];
        }
        if ($request->query->get('rarity') !== NULL)
        {
            $default['rarity'] = Rune\Rarity::tryFrom($request->query->get('rarity')) ?? $default['rarity'];
        }
        if ($request->query->get('level') !== NULL && 0 <= (int)$request->query->get('level') && (int)$request->query->get('level') <= 9)
        {
            $default['level'] = (int)$request->query->get('level');
        }
        if ($request->query->get('fst_growth_rank') !== NULL)
        {
            $default['fst_growth_rank'] = Rune\GrowthRank::tryFrom($request->query->get('fst_growth_rank')) ?? $default['fst_growth_rank'];
        }
        if ($request->query->get('snd_growth_rank') !== NULL)
        {
            $default['snd_growth_rank'] = Rune\GrowthRank::tryFrom($request->query->get('snd_growth_rank')) ?? $default['snd_growth_rank'];
        }
        if ($request->query->get('thr_growth_rank') !== NULL)
        {
            $default['thr_growth_rank'] = Rune\GrowthRank::tryFrom($request->query->get('thr_growth_rank')) ?? $default['thr_growth_rank'];
        }


        /* RUNE VALUES SOURCE */


        $dict = [
            Rune\Type::ASSAULT_FIXED->value   => [
                Rune\Rank::STAR_1->value => [
                    Rune\Rarity::COMMON->value => ['base' => 16, 'bonus' => 1],
                    Rune\Rarity::RARE->value   => ['base' => 17, 'bonus' => 2],
                    Rune\Rarity::EPIC->value   => ['base' => 19, 'bonus' => 3],
                    Rune\Rarity::LEGEND->value => ['base' => 20, 'bonus' => 4],
                ],
                Rune\Rank::STAR_2->value => [
                    Rune\Rarity::COMMON->value => ['base' => 24, 'bonus' => 3],
                    Rune\Rarity::RARE->value   => ['base' => 26, 'bonus' => 4],
                    Rune\Rarity::EPIC->value   => ['base' => 28, 'bonus' => 5],
                    Rune\Rarity::LEGEND->value => ['base' => 31, 'bonus' => 6],
                ],
                Rune\Rank::STAR_3->value => [
                    Rune\Rarity::COMMON->value => ['base' => 32, 'bonus' => 5],
                    Rune\Rarity::RARE->value   => ['base' => 35, 'bonus' => 6],
                    Rune\Rarity::EPIC->value   => ['base' => 38, 'bonus' => 7],
                    Rune\Rarity::LEGEND->value => ['base' => 41, 'bonus' => 8],
                ],
                Rune\Rank::STAR_4->value => [
                    Rune\Rarity::COMMON->value => ['base' => 48, 'bonus' => 8],
                    Rune\Rarity::RARE->value   => ['base' => 52, 'bonus' => 9],
                    Rune\Rarity::EPIC->value   => ['base' => 57, 'bonus' => 10],
                    Rune\Rarity::LEGEND->value => ['base' => 62, 'bonus' => 11],
                ],
                Rune\Rank::STAR_5->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 70, 'bonus' => 13],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_6->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 96, 'bonus' => 19],
                    Rune\Rarity::LEGEND->value => ['base' => 104, 'bonus' => 20],
                ],
            ],
            Rune\Type::ASSAULT_PERCENT->value => [
                Rune\Rank::STAR_1->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_2->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_3->value => [
                    Rune\Rarity::COMMON->value => ['base' => 8, 'bonus' => 0.24],
                    Rune\Rarity::RARE->value   => ['base' => 8.8, 'bonus' => 0.36],
                    Rune\Rarity::EPIC->value   => ['base' => 9.6, 'bonus' => 0.46],
                    Rune\Rarity::LEGEND->value => ['base' => 10.4, 'bonus' => 0.56],
                ],
                Rune\Rank::STAR_4->value => [
                    Rune\Rarity::COMMON->value => ['base' => 12, 'bonus' => 0.36],
                    Rune\Rarity::RARE->value   => ['base' => 13.2, 'bonus' => 0.54],
                    Rune\Rarity::EPIC->value   => ['base' => 14.4, 'bonus' => 0.68],
                    Rune\Rarity::LEGEND->value => ['base' => 15.6, 'bonus' => 0.82],
                ],
                Rune\Rank::STAR_5->value => [
                    Rune\Rarity::COMMON->value => ['base' => 16, 'bonus' => 0.48],
                    Rune\Rarity::RARE->value   => ['base' => 17.6, 'bonus' => 0.72],
                    Rune\Rarity::EPIC->value   => ['base' => 19.2, 'bonus' => 0.92],
                    Rune\Rarity::LEGEND->value => ['base' => 20.8, 'bonus' => 1.1],
                ],
                Rune\Rank::STAR_6->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 22, 'bonus' => 0.9],
                    Rune\Rarity::EPIC->value   => ['base' => 24, 'bonus' => 1.14],
                    Rune\Rarity::LEGEND->value => ['base' => 26, 'bonus' => 1.38],
                ],
            ],
            Rune\Type::VITAL_FIXED->value     => [
                Rune\Rank::STAR_1->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_2->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_3->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_4->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_5->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_6->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 352, 'bonus' => 72],
                    Rune\Rarity::EPIC->value   => ['base' => 384, 'bonus' => 76],
                    Rune\Rarity::LEGEND->value => ['base' => 416, 'bonus' => 80],
                ],
            ],
            Rune\Type::VITAL_PERCENT->value   => [
                Rune\Rank::STAR_1->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_2->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_3->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_4->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_5->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 20.8, 'bonus' => 1.1],
                ],
                Rune\Rank::STAR_6->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 22, 'bonus' => 0.9],
                    Rune\Rarity::EPIC->value   => ['base' => 24, 'bonus' => 1.14],
                    Rune\Rarity::LEGEND->value => ['base' => 26, 'bonus' => 1.38],
                ],
            ],
            Rune\Type::SHIELD->value          => [
                Rune\Rank::STAR_1->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_2->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_3->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_4->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_5->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 11.7, 'bonus' => 0.64],
                ],
                Rune\Rank::STAR_6->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 11, 'bonus' => 0.46],
                    Rune\Rarity::EPIC->value   => ['base' => 12, 'bonus' => 0.58],
                    Rune\Rarity::LEGEND->value => ['base' => 13, 'bonus' => 0.7],
                ],
            ],
            Rune\Type::FATAL->value           => [
                Rune\Rank::STAR_1->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_2->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_3->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_4->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_5->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_6->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 26, 'bonus' => 1.48],
                ],
            ],
            Rune\Type::RAGE->value            => [
                Rune\Rank::STAR_1->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_2->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_3->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_4->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_5->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::EPIC->value   => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::LEGEND->value => ['base' => 0, 'bonus' => 0],
                ],
                Rune\Rank::STAR_6->value => [
                    Rune\Rarity::COMMON->value => ['base' => 0, 'bonus' => 0],
                    Rune\Rarity::RARE->value   => ['base' => 44, 'bonus' => 3],
                    Rune\Rarity::EPIC->value   => ['base' => 48, 'bonus' => 3.8],
                    Rune\Rarity::LEGEND->value => ['base' => 52, 'bonus' => 4.6],
                ],
            ],
        ];


        /* EVALUATING RESULTS */


        $data = $dict[$default['type']->value][$default['rank']->value][$default['rarity']->value];

        $result = $data['base'] + ($default['level'] - ($default['level'] - $default['level'] % 3) / 3) * $data['bonus'];

        if ($default['level'] >= 3) $result += $default['fst_growth_rank']->value * $data['bonus'];
        if ($default['level'] >= 6) $result += $default['snd_growth_rank']->value * 2 * $data['bonus'];
        if ($default['level'] >= 9) $result += $default['thr_growth_rank']->value * 3 * $data['bonus'];


        /* RETURNING DATA */


        return $this->render('simulation/rune.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
            'result'    => $result,
            'default'   => $default,
        ]);
    }

    #[Route('/simulation/mythic-rune', name: 'mythic_rune_simulation')]
    public function mythicRune(Request $request): Response
    {


        /* INITIATING DEFAULT VALUES */


        $default = [];

        $default['type_one'] = Rune\MythicType::RAGE;
        $default['type_two'] = Rune\MythicType::RAGE;
        $default['level'] = 9;
        $default['fst_growth_rank'] = Rune\GrowthRank::S;
        $default['snd_growth_rank'] = Rune\GrowthRank::S;
        $default['thr_growth_rank'] = Rune\GrowthRank::S;


        /* RETRIEVING GOT VALUES */


        if ($request->query->get('type_one') !== NULL)
        {
            $default['type_one'] = Rune\MythicType::tryFrom($request->query->get('type_one')) ?? $default['type_one'];
        }
        if ($request->query->get('type_two') !== NULL)
        {
            $default['type_two'] = Rune\MythicType::tryFrom($request->query->get('type_two')) ?? $default['type_two'];
        }
        if ($request->query->get('level') !== NULL && 0 <= (int)$request->query->get('level') && (int)$request->query->get('level') <= 9)
        {
            $default['level'] = (int)$request->query->get('level');
        }
        if ($request->query->get('fst_growth_rank') !== NULL)
        {
            $default['fst_growth_rank'] = Rune\GrowthRank::tryFrom($request->query->get('fst_growth_rank')) ?? $default['fst_growth_rank'];
        }
        if ($request->query->get('snd_growth_rank') !== NULL)
        {
            $default['snd_growth_rank'] = Rune\GrowthRank::tryFrom($request->query->get('snd_growth_rank')) ?? $default['snd_growth_rank'];
        }
        if ($request->query->get('thr_growth_rank') !== NULL)
        {
            $default['thr_growth_rank'] = Rune\GrowthRank::tryFrom($request->query->get('thr_growth_rank')) ?? $default['thr_growth_rank'];
        }


        /* RUNE VALUES SOURCE */


        $dict = [
            'fst' => [
                Rune\MythicType::ASSAULT_FIXED->value   => ['base' => 56, 'bonus' => 10],
                Rune\MythicType::ASSAULT_PERCENT->value => ['base' => 13.39, 'bonus' => 0.72],
                Rune\MythicType::VITAL_FIXED->value     => ['base' => 218, 'bonus' => 42],
                Rune\MythicType::VITAL_PERCENT->value   => ['base' => 13.39, 'bonus' => 0.72],
                Rune\MythicType::SHIELD->value          => ['base' => 7.15, 'bonus' => 0.38],
                Rune\MythicType::FATAL->value           => ['base' => 13.39, 'bonus' => 0.76],
                Rune\MythicType::RAGE->value            => ['base' => 26.66, 'bonus' => 2.36],
                Rune\MythicType::AGILITY->value         => ['base' => 14.3, 'bonus' => 0.82],
                Rune\MythicType::ENDURANCE->value       => ['base' => 15.28, 'bonus' => 0.96],
                Rune\MythicType::PENETRATION->value     => ['base' => 2.64, 'bonus' => 0.2],
            ],
            'snd' => [
                Rune\MythicType::ASSAULT_FIXED->value   => ['base' => 52, 'bonus' => 10],
                Rune\MythicType::ASSAULT_PERCENT->value => ['base' => 13, 'bonus' => 0.7],
                Rune\MythicType::VITAL_FIXED->value     => ['base' => 208, 'bonus' => 40],
                Rune\MythicType::VITAL_PERCENT->value   => ['base' => 13, 'bonus' => 0.7],
                Rune\MythicType::SHIELD->value          => ['base' => 6.5, 'bonus' => 0.36],
                Rune\MythicType::FATAL->value           => ['base' => 13, 'bonus' => 0.74],
                Rune\MythicType::RAGE->value            => ['base' => 26, 'bonus' => 2.3],
                Rune\MythicType::AGILITY->value         => ['base' => 13, 'bonus' => 0.74],
                Rune\MythicType::ENDURANCE->value       => ['base' => 13.89, 'bonus' => 0.88],
                Rune\MythicType::PENETRATION->value     => ['base' => 2.4, 'bonus' => 0.2],
            ],
        ];


        /* EVALUATING RESULTS */


        $data = [
            'fst' => $dict['fst'][$default['type_one']->value],
            'snd' => $dict['snd'][$default['type_two']->value],
        ];

        $result = [
            'fst' => $data['fst']['base'] + ($default['level'] - ($default['level'] - $default['level'] % 3) / 3) * $data['fst']['bonus'],
            'snd' => $data['snd']['base'] + ($default['level'] - ($default['level'] - $default['level'] % 3) / 3) * $data['snd']['bonus'],
        ];

        if ($default['level'] >= 3)
        {
            $result['fst'] += $default['fst_growth_rank']->value * $data['fst']['bonus'];
            $result['snd'] += $default['fst_growth_rank']->value * $data['snd']['bonus'];
        }
        if ($default['level'] >= 6)
        {
            $result['fst'] += $default['fst_growth_rank']->value * 2 * $data['fst']['bonus'];
            $result['snd'] += $default['fst_growth_rank']->value * 2 * $data['snd']['bonus'];
        }
        if ($default['level'] >= 9)
        {
            $result['fst'] += $default['fst_growth_rank']->value * 3 * $data['fst']['bonus'];
            $result['snd'] += $default['fst_growth_rank']->value * 3 * $data['snd']['bonus'];
        }


        /* RETURNING DATA */


        return $this->render('simulation/mythic_rune.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
            'default'   => $default,
            'result'    => $result,
        ]);
    }

    #[Route('/simulation/soul-gear-summon', name: 'soul_gear_summon_simulation')]
    public function soulGearSummon(Request $request): Response
    {
        $discount = $request->query->get('', FALSE);

        return $this->render('simulation/soul_gear_summon.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
        ]);
    }
}