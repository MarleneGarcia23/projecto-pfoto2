<?php

/**
 * Calculate age and months of life
 * @param Date date of birth
 * @return Array age and past months since birth day
 *  
 */
function calculate_age_and_months_of_life($date_of_birth)
{
    $month_of_birth = date('m', strtotime($date_of_birth));
    $year_of_birth = date('Y', strtotime($date_of_birth));
    $actual_month = date('m');
    $actual_year = date('Y');
    if ($actual_month > $month_of_birth) {
        $age = $actual_year - $year_of_birth;
        $months_to_birth_day = $actual_month - $month_of_birth;
    } elseif ($actual_month < $month_of_birth) {
        $age = ($actual_year - $year_of_birth) - 1;
        $months_to_birth_day = 12 - ($month_of_birth - $actual_month);
    } else {
        $age = $actual_year - $year_of_birth;
        $months_to_birth_day = 0;
    }
    return ['age' => $age, 'months_to_birth_day' => $months_to_birth_day];
}
