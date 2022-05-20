<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class FormatTime
{
    // Get a date and format it friendly
    public static function LongTimeFilter($date)
    {
        if ($date == null) {
            return "Sin fecha";
        }

        $start_date = $date;
        $since_start = $start_date->diff(new \DateTime(date("Y-m-d") . " " . date("H:i:s")));

        if ($since_start->y == 0) {
            if ($since_start->m == 0) {
                if ($since_start->d == 0) {
                    if ($since_start->h == 0) {
                        if ($since_start->i == 0) {
                            if ($since_start->s == 0) {
                                $result = $since_start->s . ' SECONDS AGO';
                            } else {
                                if ($since_start->s == 1) {
                                    $result = $since_start->s . ' SECOND AGO';
                                } else {
                                    $result = $since_start->s . ' SECONDS AGO';
                                }
                            }
                        } else {
                            if ($since_start->i == 1) {
                                $result = $since_start->i . ' MINUTE AGO';
                            } else {
                                $result = $since_start->i . ' MINUTES AGO';
                            }
                        }
                    } else {
                        if ($since_start->h == 1) {
                            $result = $since_start->h . ' HOUR AGO';
                        } else {
                            $result = $since_start->h . ' HOURS AGO';
                        }
                    }
                } else {
                    if ($since_start->d == 1) {
                        $result = $since_start->d . ' DAY AGO';
                    } else {
                        $result = $since_start->d . ' DAYS AGO';
                    }
                }
            } else {
                if ($since_start->m == 1) {
                    $result = $since_start->m . ' MONTH AGO';
                } else {
                    $result = $since_start->m . ' MONTHS AGO';
                }
            }
        } else {
            if ($since_start->y == 1) {
                $result = $since_start->y . ' YEAR AGO';
            } else {
                $result = $since_start->y . ' YEARS AGO';
            }
        }

        return $result;
    }
}
