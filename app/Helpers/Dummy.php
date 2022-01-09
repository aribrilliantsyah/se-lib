<?php

namespace App\Helpers;

class Dummy
{

    public static function borrowing_history()
    {
        return [
            [
                'member' => 'Sora Amamiya',
                'book' => 'EITI SHIKKUSU',
                'date_transaction' => '01-12-2021',
                'returned' => 'no'
            ],
            [
                'member' => 'Sora Amamiya',
                'book' => 'Bokutachi no Remake',
                'date_transaction' => '30-11-2021',
                'returned' => 'yes',
            ],
            [
                'member' => 'Rira Ikuta',
                'book' => 'Eiti Shikkusu',
                'date_transaction' => '01-12-2021',
                'returned' => 'yes',
            ],
            [
                'member' => 'Rira Ikuta',
                'book' => 'Bokutachi no Remake',
                'date_transaction' => '30-11-2021',
                'returned' => 'no',
            ],
        ];
    }

    public static function popular_books()
    {
        return [
            [
                'book' => 'EITI SHIKKUSU',
                'borrower' => '7',
                'percent' => '60'
            ],
            [
                'book' => 'Bokutachi no Remake',
                'borrower' => '5',
                'percent' => '40'
            ],
        ];
    }

    public static function members()
    {
        return [
            [
                'id' => '1',
                'code' => 'MB-001',
                'photo' => 'http://jurnalotaku.com/wp-content/uploads/2015/12/celeb-sunday-sora-amamiya-hutan.jpg',
                'full_name' => 'Sora Amamiya',
                'gender' => 'Female',
                'address' => 'Planet Bekasi'
            ],
            [
                'id' => '2',
                'code' => 'MB-002',
                'photo' => 'https://1.bp.blogspot.com/-aiPaq5SVoOg/YEeES8hE3EI/AAAAAAAAAsY/Xx-8x3Jhc4M25IKMQfiG0SgF7Do89eRUgCLcBGAsYHQ/s1280/yoasobi_ikura_art202009.jpg',
                'full_name' => 'Rira Ikuta',
                'gender' => 'Female',
                'address' => 'Jaksel'
            ],
            [
                'id' => '3',
                'code' => 'MB-003',
                'photo' => 'https://i.ibb.co/j3ZbbQm/261548662-604141780866577-871485975642365831-n.jpg',
                'full_name' => 'Ari Ganteng',
                'gender' => 'Male',
                'address' => 'Bandung'
            ],
        ];
    }

    public static function borrowed_books()
    {
        return [
            [
                'id' => '1',
                'member' => 'Sora Amamiya',
                'book' => 'Eiti Shikkusu',
                'borrowed_at' => '01-12-2021',
                'returned_at' => '07-12-2021',
                'return_estimate' => '07-12-2021',
                'late_back' => 'NO',
            ],
            [
                'id' => '2',
                'member' => 'Sora Amamiya',
                'book' => 'Bokutachi no Remake',
                'borrowed_at' => '30-11-2021',
                'returned_at' => '07-12-2021',
                'return_estimate' => '06-15-2021',
                'late_back' => 'YES',
            ],
            [
                'id' => '3',
                'member' => 'Rira Ikuta',
                'book' => 'Eiti Shikkusu',
                'borrowed_at' => '01-12-2021',
                'returned_at' => '08-12-2021',
                'return_estimate' => '07-12-2021',
                'late_back' => 'NO',
            ],
            [
                'id' => '4',
                'member' => 'Rira Ikuta',
                'book' => 'Bokutachi no Remake',
                'borrowed_at' => '30-11-2021',
                'returned_at' => '07-12-2021',
                'return_estimate' => '06-15-2021',
                'late_back' => 'YES',
            ],
        ];
    }

    public static function authors()
    {
        return [
            [
                'id' => '1',
                'author' => 'Asato Asato',
            ],
            [
                'id' => '2',
                'author' => 'Fujino Ōmori',
            ],
            [
                'id' => '3',
                'author' => 'Chu - Gong',
            ],
            [
                'id' => '3',
                'author' => 'Fiersa besari',
            ],
        ];
    }

    public static function categories()
    {
        return [
            [
                'id' => '1',
                'category' => 'Fantasy',
            ],
            [
                'id' => '2',
                'category' => 'War',
            ],
            [
                'id' => '3',
                'category' => 'Slice of Life',
            ],
            [
                'id' => '4',
                'category' => 'Comedy',
            ],
        ];
    }

    public static function books()
    {
        return [
            [
                'id' => '1',
                'cover' => 'https://pbs.twimg.com/media/DoNt9SyV4AAWq2Z.jpg',
                'code' => 'BK-001',
                'category' => [
                    'Fantasy',
                    'War',
                    'Romance'
                ],
                'author' => 'Asato Asato',
                'book' => 'Eiti Shikkusu',
                'summary' => 'Republik San Magnolia telah berperang dengan Kekaisaran Giad selama sembilan tahun.. Meskipun awalny...',
            ],
            [
                'id' => '2',
                'cover' => 'https://cdn.novelupdates.com/images/2021/09/Bokutachi-no-Remake-Ver.png',
                'code' => 'BK-002',
                'category' => [
                    'Slice of Life',
                    'Comedy',
                    'Romance'
                ],
                'author' => 'Kionachi',
                'book' => 'Bokutachi no Remake',
                'summary' => 'Bokutachi No Remake umumnya berpusat pada developer game bernama Hashiba Kyouka yang telah berusia 28 tahun....',
            ],
        ];
    }

    public static function borrow_logs()
    {
        return [
            [
                'id' => '1',
                'member' => 'Sora Amamiya',
                'book' => 'Eiti Shikkusu',
                'borrowed_at' => '01-12-2021',
                'returned_at' => '07-12-2021',
                'return_estimate' => '07-12-2021',
                'late_back' => 'NO',
            ],
            [
                'id' => '2',
                'member' => 'Sora Amamiya',
                'book' => 'Bokutachi no Remake',
                'borrowed_at' => '30-11-2021',
                'returned_at' => '07-12-2021',
                'return_estimate' => '06-15-2021',
                'late_back' => 'YES',
            ],
            [
                'id' => '3',
                'member' => 'Rira Ikuta',
                'book' => 'Eiti Shikkusu',
                'borrowed_at' => '01-12-2021',
                'returned_at' => '07-12-2021',
                'return_estimate' => '07-12-2021',
                'late_back' => 'NO',
            ],
            [
                'id' => '4',
                'member' => 'Rira Ikuta',
                'book' => 'Bokutachi no Remake',
                'borrowed_at' => '30-11-2021',
                'returned_at' => '07-12-2021',
                'return_estimate' => '06-15-2021',
                'late_back' => 'YES',
            ],
        ];
    }

    public static function roles()
    {
        return [
            [
                'id' => '1',
                'role' => 'Super Admin',
            ],
            [
                'id' => '2',
                'role' => 'Operator',
            ],
            [
                'id' => '3',
                'role' => 'Member',
            ],
        ];
    }

    public static function users()
    {
        return [
            [
                'id' => '1',
                'username' => 'ujangwomanslayer',
                'email' => 'ujang@gmail.com',
                'fullname' => 'Ujang Komarudin',
                'role' => 'Super Admin',
            ],
            [
                'id' => '2',
                'username' => 'rahayu',
                'email' => 'rahayu@gmail.com',
                'fullname' => 'Rahayu hayu',
                'role' => 'Operator',
            ],
        ];
    }
}
