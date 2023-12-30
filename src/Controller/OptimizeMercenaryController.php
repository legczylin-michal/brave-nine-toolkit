<?php

namespace App\Controller;

use App\Enum\Available;
use App\Enum\MythicMercenaryBonus;
use App\Enum\MercenaryRank;
use App\Enum\StatType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OptimizeMercenaryController extends AbstractController
{
    public static function CartesianProduct(array $columns): array
    {
        if (count($columns) == 0) return [];

        // let's calculate how many tuples we should generate
        $tuplesCount = 1;
        foreach ($columns as $column)
        {
            $tuplesCount *= count($column);
        }

        // get key names of $subsets so to address its values without problem
        // no matter whether is it a list or an associative array
        $columnsNames = array_keys($columns);

        // iterators to keep track of what value should now go into tuple
        $iterators = array_fill(0, count($columns), 0);

        // initiate result set
        $result = [];
        for ($row = 0; $row < $tuplesCount; $row++)
        {
            // create empty tuple
            $tuple = [];

            // do sth with $tuple
            for ($col = 0; $col < count($columns); $col++)
            {
                $tuple[$columnsNames[$col]] = $columns[$columnsNames[$col]][$iterators[$col]];
            }

            // increase last column iterator
            $iterators[count($columns) - 1]++;

            // main idea: if nth column iterator met its final value aka index of last element
            // then reset this iterator to zero and increase iterator of the previous column by one
            // (it was easier for me to think that way - moving main point from right to left
            // if you were to visualise this process)
            for ($col = count($columns) - 1; $col > 0; $col--)
            {
                // Why is +1 here? Let's look at example.
                // Suppose $iterator[$col] happens to be 0.
                // Then no matter size of current column - count($columns[$columnsNames[$col]]) -
                // (which decides whether this element - $iterator[$col] - is the last one or not)
                // evaluation will return true and so will move iterators of previous columns,
                // which I clearly do not want to happen.
                // So instead, in this solution it will be 1 compared with total size of column + 1.
                // Then the only possible case for evaluation to be true if
                // ($iterators[$col] + 1) is equal to (count($columns[$columnsNames[$col]]) + 1)
                // that implies $iterators[$col] and count($columns[$columnsNames[$col]]) are equal
                // which means that current iterator is exactly the last one in column, so
                // we should reset it and move next column iterator.
                if (($iterators[$col] + 1) % (count($columns[$columnsNames[$col]]) + 1) == 0)
                {
                    $iterators[$col] = 0;
                    $iterators[$col - 1]++;
                }
            }

            // add tuple to result set
            $result[] = $tuple;
        }

        return $result;
    }

    #[Route('/optimize-mercenary', name: 'optimize_mercenary')]
    public function index(Request $request): Response
    {


        /* INITIATING DEFAULT VALUES */


        $default = [];

        $default["optimized_stat"] = StatType::ATK;
        $default["base_value"] = 480;
        $default["rune_fixed"] = 584;
        $default["rune_percent"] = 59.12;
        $default["mythic_rune_first_half_fixed"] = 96;
        $default["mythic_rune_second_half_fixed"] = 92;
        $default["mythic_rune_first_half_percent"] = 16.27;
        $default["mythic_rune_second_half_percent"] = 15.8;
        $default["rune_one_availability"] = Available::FALSE;
        $default["rune_two_availability"] = Available::FALSE;
        $default["mythic_rune_first_half_availability"] = Available::FALSE;
        $default["mythic_rune_second_half_availability"] = Available::FALSE;
        $default["rune_one_option_availability"] = Available::TRUE;
        $default["rune_two_option_availability"] = Available::TRUE;
        $default["mythic_rune_option_availability"] = Available::FALSE;
        $default["non_amulet_enhancement_level"] = 25;
        $default["amulet_enhancement_level"] = 25;
        $default["amulet_first_half_availability"] = Available::FALSE;
        $default["amulet_second_half_availability"] = Available::FALSE;
        $default["insignia_rank"] = MercenaryRank::STAR_5;
        $default["set_effect_activation_level"] = 0;
        $default["mythic_mercenary_bonus"] = MythicMercenaryBonus::INACTIVE;


        /* RETRIEVING GOT VALUES */


        // selected optimized statistic: either ATK or HP
        if ($request->query->get('optimized_stat') !== NULL)
        {
            $default["optimized_stat"] = StatType::tryFrom($request->query->get("optimized_stat")) ?? $default["optimized_stat"];
        }

        // base value of statistic
        if ($request->query->get('base_value') !== NULL && (int)$request->query->get('base_value') > 0)
        {
            $default["base_value"] = (int)$request->query->get('base_value');
        }

        // example rune fixed value
        if ($request->query->get('rune_fixed') !== NULL && (int)$request->query->get('rune_fixed') > 0)
        {
            $default["rune_fixed"] = (int)$request->query->get('rune_fixed');
        }

        // example rune percent value
        if ($request->query->get('rune_percent') !== NULL && (float)$request->query->get('rune_percent') > 0)
        {
            $default["rune_percent"] = (float)$request->query->get('rune_percent');
        }

        // example mythic rune first half fixed value
        if ($request->query->get('mythic_rune_first_half_fixed') !== NULL && (float)$request->query->get('mythic_rune_first_half_fixed') > 0)
        {
            $default["mythic_rune_first_half_fixed"] = (float)$request->query->get('mythic_rune_first_half_fixed');
        }

        // example mythic rune second half fixed value
        if ($request->query->get('mythic_rune_second_half_fixed') !== NULL && (float)$request->query->get('mythic_rune_second_half_fixed') > 0)
        {
            $default["mythic_rune_second_half_fixed"] = (float)$request->query->get('mythic_rune_second_half_fixed');
        }

        // example mythic rune first half percent value
        if ($request->query->get('mythic_rune_first_half_percent') !== NULL && (float)$request->query->get('mythic_rune_first_half_percent') > 0)
        {
            $default["mythic_rune_first_half_percent"] = (float)$request->query->get('mythic_rune_first_half_percent');
        }

        // example mythic rune second half percent value
        if ($request->query->get('mythic_rune_second_half_percent') !== NULL && (float)$request->query->get('mythic_rune_second_half_percent') > 0)
        {
            $default["mythic_rune_second_half_percent"] = (float)$request->query->get('mythic_rune_second_half_percent');
        }

        // is rune one available
        if ($request->query->get('rune_one_availability') !== NULL)
        {
            $default["rune_one_availability"] = Available::tryFrom($request->query->get("rune_one_availability"))
                ??
                $default["rune_one_availability"];
        }

        // is rune two available
        if ($request->query->get('rune_two_availability') !== NULL)
        {
            $default["rune_two_availability"] = Available::tryFrom($request->query->get("rune_two_availability"))
                ??
                $default["rune_two_availability"];
        }

        // is mythic rune first half available
        if ($request->query->get('mythic_rune_first_half_availability') !== NULL)
        {
            $default["mythic_rune_first_half_availability"] = Available::tryFrom($request->query->get("mythic_rune_first_half_availability"))
                ??
                $default["mythic_rune_first_half_availability"];
        }

        // is mythic rune second half available
        if ($request->query->get('mythic_rune_second_half_availability') !== NULL)
        {
            $default["mythic_rune_second_half_availability"] = Available::tryFrom($request->query->get("mythic_rune_second_half_availability"))
                ??
                $default["mythic_rune_second_half_availability"];
        }

        // is rune one option available
        if ($request->query->get('rune_one_option_availability') !== NULL)
        {
            $default["rune_one_option_availability"] = Available::tryFrom($request->query->get("rune_one_option_availability"))
                ??
                $default["rune_one_option_availability"];
        }

        // is rune two option available
        if ($request->query->get('rune_two_option_availability') !== NULL)
        {
            $default["rune_two_option_availability"] = Available::tryFrom($request->query->get("rune_two_option_availability"))
                ??
                $default["rune_two_option_availability"];
        }

        // is mythic rune option available
        if ($request->query->get('mythic_rune_option_availability') !== NULL)
        {
            $default["mythic_rune_option_availability"] = Available::tryFrom($request->query->get("mythic_rune_option_availability"))
                ??
                $default["mythic_rune_option_availability"];
        }

        // weapon/armour enhancement level
        if ($request->query->get('non_amulet_enhancement_level') !== NULL &&
            0 <= (int)$request->query->get('non_amulet_enhancement_level') &&
            (int)$request->query->get('non_amulet_enhancement_level') <= 25)
        {
            $default['non_amulet_enhancement_level'] = (int)$request->query->get('non_amulet_enhancement_level');
        }

        // amulet enhancement level
        if ($request->query->get('amulet_enhancement_level') !== NULL &&
            0 <= (int)$request->query->get('amulet_enhancement_level') &&
            (int)$request->query->get('amulet_enhancement_level') <= 25)
        {
            $default['amulet_enhancement_level'] = (int)$request->query->get('amulet_enhancement_level');
        }

        // is amulet first half available
        if ($request->query->get('amulet_first_half_availability') !== NULL)
        {
            $default["amulet_first_half_availability"] = Available::tryFrom($request->query->get("amulet_first_half_availability"))
                ??
                $default["amulet_first_half_availability"];
        }

        // is amulet second half available
        if ($request->query->get('amulet_second_half_availability') !== NULL)
        {
            $default["amulet_second_half_availability"] = Available::tryFrom($request->query->get("amulet_second_half_availability"))
                ??
                $default["amulet_second_half_availability"];
        }

        // highest rank insignia can be applied
        if ($request->query->get('insignia_rank') !== NULL)
        {
            $default["insignia_rank"] = MercenaryRank::tryFrom($request->query->get("insignia_rank")) ?? $default["insignia_rank"];
        }

        // set effect activation level
        if ($request->query->get('set_effect_activation_level') !== NULL &&
            0 <= (int)$request->query->get('set_effect_activation_level') &&
            (int)$request->query->get('set_effect_activation_level') <= 5)
        {
            $default['set_effect_activation_level'] = (int)$request->query->get('set_effect_activation_level');
        }

        // is mythic mercenary bonus applied
        if ($request->query->get('mythic_mercenary_bonus') !== NULL)
        {
            $default["mythic_mercenary_bonus"] = MythicMercenaryBonus::tryFrom($request->query->get("mythic_mercenary_bonus"))
                ??
                $default["mythic_mercenary_bonus"];
        }


        /* FORMING DATA TABLE */


        $columns = [];

        if ($default['rune_one_availability'] == Available::TRUE) $columns['Rune 1'] = ['fixed', '%',];
        elseif ($default['rune_one_option_availability'] == Available::TRUE) $columns['Rune 1 Option'] = ['fixed', '%',];

        if ($default['rune_two_availability'] == Available::TRUE) $columns['Rune 2'] = ['fixed', '%',];
        elseif ($default['rune_two_option_availability'] == Available::TRUE) $columns['Rune 2 Option'] = ['fixed', '%',];

        if ($default['mythic_rune_first_half_availability'] == Available::TRUE) $columns['Mythic Rune 1st Half'] = ['fixed', '%',];
        if ($default['mythic_rune_second_half_availability'] == Available::TRUE) $columns['Mythic Rune 2nd Half'] = ['fixed', '%',];
        if ($default['mythic_rune_option_availability'] == Available::TRUE) $columns['Mythic Rune Option'] = ['fixed', '%',];

        if ($default['amulet_first_half_availability'] == Available::TRUE) $columns['Amulet 1st Half'] = ['fixed', '%',];
        if ($default['amulet_second_half_availability'] == Available::TRUE) $columns['Amulet 2nd Half'] = ['fixed', '%',];

        $table = self::CartesianProductRecursive($columns);


        /* EVALUATING RESULTS */


        $optionMap = [
            'ATK' => [
                'fixed' => 138,
                '%'     => 8,
            ],
            'HP'  => [
                'fixed' => 552,
                '%'     => 8,
            ],
        ];

        $nonAmuletMap = [];

        $amuletMap = [
            'ATK' => [
                'fixed' => [],
                '%'     => [],
            ],
            'HP'  => [
                'fixed' => [],
                '%'     => [],
            ],
        ];

        for ($i = 0; $i <= 25; $i++)
        {
            $mul = $i;
            if ($i > 10) $mul += $i - 10;

            $nonAmuletMap[$i] = $mul * 0.5;

            $amuletMap['ATK'][$i] = ['fixed' => $mul * 5, '%' => $mul * 0.5];
            $amuletMap['HP'][$i] = ['fixed' => $mul * 20, '%' => $mul * 0.5];
        }

        $setEffectMap = [
            'ATK' => [
                0 => 0,
                1 => 15,
                2 => 17.5,
                3 => 20,
                4 => 22.5,
                5 => 25,
            ],
            'HP'  => [
                0 => 0,
                1 => 18,
                2 => 21,
                3 => 24,
                4 => 27,
                5 => 30,
            ],
        ];

        $mythicBonusMap = [
            'ATK' => [
                'INACTIVE' => 0,
                'ACTIVE'   => 10,
            ],
            'HP'  => [
                'INACTIVE' => 0,
                'ACTIVE'   => 10,
            ],
        ];

        // shortcuts
        $option = $optionMap[$default['optimized_stat']->value];
        $nonAmulet = $nonAmuletMap[$default['non_amulet_enhancement_level']];
        $amulet = $amuletMap[$default['optimized_stat']->value][$default['amulet_enhancement_level']];
        $setEffect = $setEffectMap[$default['optimized_stat']->value][$default['set_effect_activation_level']];
        $mythicBonus = $mythicBonusMap[$default['optimized_stat']->value][$default['mythic_mercenary_bonus']->value];
        $rune = ['fixed' => $default['rune_fixed'], '%' => $default['rune_percent']];
        $mRune = [
            '1st' => ['fixed' => $default['mythic_rune_first_half_fixed'], '%' => $default['mythic_rune_first_half_percent'],],
            '2nd' => ['fixed' => $default['mythic_rune_second_half_fixed'], '%' => $default['mythic_rune_second_half_percent'],],
        ];

        if (count($table) == 0) $table[]['Result'] = $default['base_value'];
        else
        {
            for ($row = 0; $row < count($table); $row++)
            {
                $boost = ['fixed' => $default['base_value'], '%' => 100];

                foreach ($table[$row] as $key => &$item)
                {
                    // applying boosts
                    if (in_array($key, ['Rune 1', 'Rune 2']))
                    {
                        $boost[$item] += $rune[$item];

                        if ($key == 'Rune 1' && $default['rune_one_option_availability'])
                        {
                            $tmp = $item == '%' ? 'fixed' : '%';
                            $boost[$tmp] += $option[$tmp];
                        }

                        if ($key == 'Rune 2' && $default['rune_two_availability'])
                        {
                            $tmp = $item == '%' ? 'fixed' : '%';
                            $boost[$tmp] += $option[$tmp];
                        }
                    }
                    if (in_array($key, ['Rune 1 Option', 'Rune 2 Option'])) $boost[$item] += $option[$item];

                    if ($key == 'Mythic Rune 1st Half') $boost[$item] += $mRune['1st'][$item];
                    if ($key == 'Mythic Rune 2nd Half') $boost[$item] += $mRune['2nd'][$item];
                    if ($key == 'Mythic Rune Option') $boost[$item] += $option[$item];

                    if (in_array($key, ['Amulet 1st Half', 'Amulet 2nd Half'])) $boost[$item] += $amulet[$item];

                    // renaming cell contents so table will be easier to read
                    if (in_array($key, ['Rune 1', 'Rune 2'])) $item = $rune[$item] . ($item == '%' ? '%' : '');
                    if (in_array($key, ['Rune 1 Option', 'Rune 2 Option'])) $item = $option[$item] . ($item == '%' ? '%' : '');

                    if ($key == 'Mythic Rune 1st Half') $item = $mRune['1st'][$item] . ($item == '%' ? '%' : '');
                    if ($key == 'Mythic Rune 2nd Half') $item = $mRune['2nd'][$item] . ($item == '%' ? '%' : '');
                    if ($key == 'Mythic Rune Option') $item = $option[$item] . ($item == '%' ? '%' : '');

                    if (in_array($key, ['Amulet 1st Half', 'Amulet 2nd Half'])) $item = $amulet[$item] . ($item == '%' ? '%' : '');
                }

                $boost['%'] += $nonAmulet;

                $table[$row]['Result'] = round($boost['fixed'] * $boost['%'] / 100 * (100 + $setEffect) / 100 * (100 + $mythicBonus) / 100);
            }
        }

        usort($table, function ($a, $b) { return $a['Result'] <= $b['Result']; });


        /* RETURNING DATA */


        return $this->render('optimize_mercenary/index.html.twig', [
            'random_id' => bin2hex(random_bytes(8)),
            'table'     => $table,
            'default'   => $default,
        ]);
    }

    public static function CartesianProductRecursive(array $subsets): array
    {
        if (count($subsets) == 0) return [];

        $keys = array_keys($subsets);

        if (count($subsets) == 1)
        {
            $result = [];

            foreach ($subsets[$keys[0]] as $value) $result[] = [$keys[0] => $value];

            return $result;
        }

        $fstCol = [$keys[0] => $subsets[$keys[0]]];
        $rest = self::CartesianProductRecursive(array_slice($subsets, 1));

        $result = [];
        foreach ($fstCol[array_keys($fstCol)[0]] as $item1)
        {
            foreach ($rest as $key => $item2)
            {
                $tuple = array_merge([array_keys($fstCol)[0] => $item1], $item2);

                $result[] = $tuple;
            }
        }

        return $result;
    }
}