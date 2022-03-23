<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types = 1);

class Tournament
{
    private string $header;
    private array $teams;

    public function __construct()
    {
        $this->header = 'Team                           | MP |  W |  D |  L |  P';
    }

    public function tally(string $scores)
    {
        $this->teams = [];

        if (empty($scores)) {
            return $this->header;
        }

        $input = explode("\n", $scores);

        foreach ($input as $inputLine) {
            $game = explode(';', $inputLine);

            if ($game[2] === 'draw') {
                $this->teamPlayedTied($game[0]);
                $this->teamPlayedTied($game[1]);
                continue;
            }

            if ($game[2] === 'loss') {
                $this->teamLost($game[0]);
                $this->teamWon($game[1]);
                continue;
            }

            if ($game[2] === 'win') {
                $this->teamWon($game[0]);
                $this->teamLost($game[1]);
            }
        }

        return $this->generateTable();
    }

    private function teamPlayedTied(string $team): void
    {
        if (empty($this->teams[$team])) {
            $this->generateTeamLine($team);
        }

        $this->teams[$team]['MP']++;
        $this->teams[$team]['D']++;
        $this->teams[$team]['P']++;
    }

    private function teamLost(string $team): void
    {
        if (empty($this->teams[$team])) {
            $this->generateTeamLine($team);
        }

        $this->teams[$team]['MP']++;
        $this->teams[$team]['L']++;
    }

    private function teamWon(string $team): void
    {
        if (empty($this->teams[$team])) {
            $this->generateTeamLine($team);
        }

        $this->teams[$team]['MP']++;
        $this->teams[$team]['W']++;
        $this->teams[$team]['P'] = $this->teams[$team]['P'] + 3;
    }

    private function generateTeamLine(string $team)
    {
        $this->teams[$team] = [
            'Name' => $team,
            'MP'   => 0,
            'W'    => 0,
            'D'    => 0,
            'L'    => 0,
            'P'    => 0,
        ];
    }

    private function generateTable(): string
    {
        $table = '';
        $this->sortTeamsByResult();

        if (false === empty($this->teams)) {
            $table = $table . $this->header;
            foreach ($this->teams as $teamName => $results) {
                $table .= $this->generateResultLine($teamName);
            }

        }

        return $table;
    }

    private function generateResultLine(string $teamName)
    {
        $columHeader       = explode('|', $this->header);
        $columHeaderLength = strlen($columHeader[0]);
        $name              = $teamName;

        while (strlen($name) < $columHeaderLength) {
            $name .= ' ';
        }

        return sprintf("\n%s|  %s |  %s |  %s |  %s |  %s",
            $name,
            $this->teams[$teamName]['MP'],
            $this->teams[$teamName]['W'],
            $this->teams[$teamName]['D'],
            $this->teams[$teamName]['L'],
            $this->teams[$teamName]['P'],
        );
    }

    private function sortTeamsByResult()
    {
        usort($this->teams, function ($team1, $team2) {
            if ($team1['P'] > $team2['P']) {
                return -1;
            }

            if ($team1['P'] < $team2['P']) {
                return 1;
            }

            if (substr($team1['Name'], 0, 1) > substr($team2['Name'], 0, 1)) {
                return 1;
            } else {
                return 0;
            }
        });

        foreach ($this->teams as $key => $results) {
            $this->teams[$results['Name']] = $results;
            unset($this->teams[$key]);
        }
    }
}
