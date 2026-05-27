<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Bookimport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $path = $row['cover']->storeAs;

        return new Book([
            'title'        => $row['judul'] ?? 'Tanpa Judul',
            'author'       => $row['penulis'] ?? 'Tanpa Penulis',
            'year'         => $row['tahun_terbit'] ?? date('Y'),
            'publisher'    => $row['penerbit'] ?? 'Tanpa Penerbit',
            'city'         => $row['kota_terbit'] ?? 'Tidak diketahui',
            'cover'        => $row['cover'] ?? 'kosong',
            'bookshelf_id' => 1,
        ]);
    }
}
