<?php

namespace App\TestTask\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\ArrayShape;

class TestTaskService
{
    private int $affectedRows = 0;

    #[ArrayShape(['total' => "int", 'inserted' => "int", 'updated' => "int"])] public function resolve(array $rows): array
    {
        $importRows = array_map(
            function ($item) {
                return [
                    'first_name'    => $item['name']['first'],
                    'last_name'     => $item['name']['last'],
                    'email'         => $item['email'],
                    'age'           => $item['dob']['age'],
                ];
            },
            $rows['results'] ?? []
        );

        $now = Carbon::now();
        $dbTotal = User::count();

        if ($importRows) {
            DB::transaction(function () use ($importRows, $now) {
                $this->affectedRows = User::upsert(
                    $importRows,
                    ['first_name', 'last_name'],
                    ['email', 'age', 'updated_at' => $now],
                );
            });
        }

        $inserted = count($importRows) - ($this->affectedRows - count($importRows));
        $updated = $this->affectedRows - count($importRows);

        return [
            'total'     => $dbTotal + $inserted,
            'inserted'  => $inserted,
            'updated'   => $updated,
        ];
    }
}
