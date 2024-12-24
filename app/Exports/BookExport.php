<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BookExport implements FromCollection, WithMapping, WithColumnFormatting, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::all();
    }   
        /**
        * @param Book $book
        */
        public function map($book): array
        {
            return [
                $book->name,
                $book->user->name,
                $book->price,
                Date::dateTimeToExcel($book->created_at),
                $book->updated_at,
            ];
        }
        /**
         * Summary of columnFormats
         * @return array
         */
        public function columnFormats(): array{
            return [
                'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            ];
        }   
           public function headings(): array
            {
                return [
                    'Kitap Adı','Ekleyen','fiyat','Oluşturma Tarihi','Güncelleme Tarihi'
                ];    
            }
}











 