<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
        [
            'title' => '나 혼자만 레벨업 14 [Na Honjaman Level Up 14]',
            'author' => 'Chugong',
            'desc' => '“…후회하지 않으십니까?” “몇 번이고 다시 기회가 주어져도, 전 같은 선택을 할 겁니다.” ‘윤회의 잔’으로 모든 것을 되돌린 후의 세계. 성진우는 고등학생으로서 평범한(?) 생활을 이어 가고, ‘개미 괴물’을 보는 형사, 우진철과 조우한다. 그리고 긴긴 시간을 돌아 다시 만나게 되는 진우와 해인!! 과연 이 평화는 오래 지속될 수 있을까?! *14권은 웹툰 외전 1~11화 연재분의 편집본입니다.',
            'price' => 17.99,
            'stock' => 3,
            'publisher' => '디앤씨미디어',
            'page_count' => 312,
            'cover_image' => 'book_cover_images/나 혼자만 레벨업 14.jpg', 
        ],
        [
            'title' => 'The Magnolia Sword: A Ballad of Mulan',
            'author' => 'Sherry Thomas',
            'desc' => 'A Warrior in Disguise All her life, Mulan has trained for one purpose: to win the duel that every generation in her family must fight. If she prevails, she can reunite a pair of priceless heirloom swords separated decades earlier, and avenge her father, who was paralyzed in his own duel. Then a messenger from the Emperor arrives...',
            'price' => 10.99,
            'stock' => 9,
            'publisher' => 'Lee & Low Books',
            'page_count' => 348,
            'cover_image' => 'book_cover_images/TheMagnoliaSword_ABalladofMulan.jpg',
        ],
        [
            'title' => 'Battle of the Bookstores',
            'author' => 'Ali Brady',
            'desc' => 'Rivalry and romance spark when two bookstore managers who are opposites in every way find themselves competing for the same promotion...',
            'price' => 17.85,
            'stock' => 24,
            'publisher' => 'Berkley',
            'page_count' => 414,
            'cover_image' => 'book_cover_images/BattleoftheBookstores.jpg',
        ],
        [
            'title' => 'A Royal Mile',
            'author' => 'Samantha Young',
            'desc' => 'A steamy enemies-to-friends-to-lovers romance from New York Times Bestselling Author Samantha Young...',
            'price' => 25.20,
            'stock' => 4,
            'publisher' => 'Samantha Young',
            'page_count' => 438,
            'cover_image' => 'book_cover_images/ARoyalMile.jpg',
        ],
        [
            'title' => 'People We Meet on Vacation',
            'author' => 'Emily Henry',
            'desc' => 'Two best friends. Ten summer trips. One last chance to fall in love...',
            'price' => 7.55,
            'stock' => 57,
            'publisher' => 'A Jove Book, Berkley',
            'page_count' => 120,
            'cover_image' => 'book_cover_images/PeopleWeMeetonVacation.jpg',
        ],
        [
            'title' => 'NARUTO -ナルト- 巻ノ四十三',
            'author' => 'Masashi Kishimoto',
            'desc' => 'この術は絶対にかわせない！ イタチの“天照”を誘い最後の攻撃に出るサスケ...',
            'price' => 20.00,
            'stock' => 10,
            'publisher' => 'コミック',
            'page_count' => 218,
            'cover_image' => 'book_cover_images/NARUTOVol43.jpg',
        ],
        [
            'title' => 'Harry Potter and the Philosopher’s Stone',
            'author' => 'J.K. Rowling',
            'desc' => 'Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive...',
            'price' => 5.66,
            'stock' => 6,
            'publisher' => 'Kindle Edition',
            'page_count' => 470,
            'cover_image' => 'book_cover_images/HarryPotterandthePhilosophersStone.jpg',
        ],
        [
            'title' => 'Thinking, Fast and Slow',
            'author' => 'Daniel Kahneman',
            'desc' => 'In the highly anticipated Thinking, Fast and Slow, Kahneman takes us on a groundbreaking tour of the mind and explains the two systems that drive the way we think...',
            'price' => 6.50,
            'stock' => 5,
            'publisher' => 'Abc Publisher',
            'page_count' => 314,
            'cover_image' => 'book_cover_images/Thinking, Fast and Slow.jpg',
        ],
        
    ]);
    Book::find(1)?->categories()->attach([1, 3, 7, 8]);
    Book::find(2)?->categories()->attach([3, 4, 8, 6]);
    Book::find(3)?->categories()->attach([6]);
    Book::find(4)?->categories()->attach([3, 4, 8]);
    Book::find(5)?->categories()->attach([3, 4, 8]);
    Book::find(6)?->categories()->attach([3, 4, 8]);
    Book::find(7)?->categories()->attach([3, 4, 8]);
    Book::find(8)?->categories()->attach([12, 13, 14]);
    }
}
